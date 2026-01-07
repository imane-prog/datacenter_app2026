<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resource_id',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'justification',
        'description',
        'statut',
        'approved_by',
        'response_message',
        'responded_at',
        'incident_report',
        'incident_reported_at',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'responded_at' => 'datetime',
        'incident_reported_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function hasConflict($resourceId, $dateDebut, $dateFin, $excludeId = null)
    {
        $query = self::where('resource_id', $resourceId)
            ->whereIn('statut', ['pending', 'approved', 'active'])
            ->where(function ($q) use ($dateDebut, $dateFin) {
                $q->whereBetween('date_debut', [$dateDebut, $dateFin])
                  ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                  ->orWhere(function ($q2) use ($dateDebut, $dateFin) {
                      $q2->where('date_debut', '<=', $dateDebut)
                         ->where('date_fin', '>=', $dateFin);
                  });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public static function getConflicts($resourceId, $dateDebut, $dateFin, $excludeId = null)
    {
        $query = self::where('resource_id', $resourceId)
            ->whereIn('statut', ['pending', 'approved', 'active'])
            ->where(function ($q) use ($dateDebut, $dateFin) {
                $q->whereBetween('date_debut', [$dateDebut, $dateFin])
                  ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                  ->orWhere(function ($q2) use ($dateDebut, $dateFin) {
                      $q2->where('date_debut', '<=', $dateDebut)
                         ->where('date_fin', '>=', $dateFin);
                  });
            })
            ->with('user');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }

    public function isActive()
    {
        return $this->statut === 'active' && 
               Carbon::now()->between($this->date_debut, $this->date_fin);
    }

    public function isCompleted()
    {
        return $this->statut === 'completed' || 
               ($this->statut === 'active' && Carbon::now()->gt($this->date_fin));
    }

    public function canBeModified()
    {
        return in_array($this->statut, ['pending', 'approved']) && 
               Carbon::now()->lt($this->date_debut);
    }

    public function canBeCancelled()
    {
        return in_array($this->statut, ['pending', 'approved']) && 
               Carbon::now()->lt($this->date_debut);
    }

    public function getDurationInDays()
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }

    public function getStatusBadgeClass()
    {
        return [
            'pending' => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            'active' => 'badge-primary',
            'completed' => 'badge-secondary',
            'cancelled' => 'badge-dark',
        ][$this->statut] ?? 'badge-light';
    }

    public function getStatusText()
    {
        return [
            'pending' => 'En attente',
            'approved' => 'Approuvée',
            'rejected' => 'Refusée',
            'active' => 'Active',
            'completed' => 'Terminée',
            'cancelled' => 'Annulée',
        ][$this->statut] ?? $this->statut;
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('statut', $status);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForResource($query, $resourceId)
    {
        return $query->where('resource_id', $resourceId);
    }

    public static function updateExpiredReservations()
    {
        self::where('statut', 'active')
            ->where('date_fin', '<', Carbon::now())
            ->update(['statut' => 'completed']);
    }
}
