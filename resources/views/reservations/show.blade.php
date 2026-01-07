<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Réservation - Data Center</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        h1 {
            color: #333;
            font-size: 28px;
        }

        .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-primary { background: #cce5ff; color: #004085; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }

        .section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 15px;
            color: #333;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            background: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary { background: #6c757d; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-warning { background: #ffc107; color: #000; }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .response-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            margin-top: 15px;
        }

        .response-box h4 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .response-box p {
            color: #333;
            line-height: 1.6;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
        }

        .modal-content h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📄 Détails de la réservation</h1>
            <span class="badge badge-{{ 
                $reservation->statut == 'pending' ? 'warning' : 
                ($reservation->statut == 'approved' ? 'success' : 
                ($reservation->statut == 'rejected' ? 'danger' : 
                ($reservation->statut == 'active' ? 'primary' : 'secondary'))) 
            }}">
                {{ $reservation->getStatusText() }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="section">
            <h2>🖥️ Ressource</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nom</span>
                    <span class="info-value">{{ $reservation->resource->nom }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type</span>
                    <span class="info-value">{{ $reservation->resource->type }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">CPU</span>
                    <span class="info-value">{{ $reservation->resource->cpu }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">RAM</span>
                    <span class="info-value">{{ $reservation->resource->ram }}</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>📅 Période de réservation</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Date de début</span>
                    <span class="info-value">{{ $reservation->date_debut->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de fin</span>
                    <span class="info-value">{{ $reservation->date_fin->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Durée</span>
                    <span class="info-value">{{ $reservation->getDurationInDays() }} jour(s)</span>
                </div>
                @if($reservation->heure_debut)
                    <div class="info-item">
                        <span class="info-label">Horaires</span>
                        <span class="info-value">{{ $reservation->heure_debut }} - {{ $reservation->heure_fin }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="section">
            <h2>📝 Justification</h2>
            <p style="color: #333; line-height: 1.6;">{{ $reservation->justification }}</p>
            
            @if($reservation->description)
                <h4 style="margin-top: 20px; margin-bottom: 10px; color: #666; font-size: 14px;">Description complémentaire</h4>
                <p style="color: #333; line-height: 1.6;">{{ $reservation->description }}</p>
            @endif
        </div>

        @if($reservation->response_message)
            <div class="section">
                <h2>💬 Réponse du gestionnaire</h2>
                <div class="response-box">
                    <h4>{{ $reservation->approvedBy ? $reservation->approvedBy->name : 'Gestionnaire' }} 
                        - {{ $reservation->responded_at->format('d/m/Y à H:i') }}</h4>
                    <p>{{ $reservation->response_message }}</p>
                </div>
            </div>
        @endif

        @if($reservation->incident_report)
            <div class="section">
                <h2>⚠️ Incident signalé</h2>
                <div class="response-box" style="border-left-color: #dc3545;">
                    <h4>Signalé le {{ $reservation->incident_reported_at->format('d/m/Y à H:i') }}</h4>
                    <p>{{ $reservation->incident_report }}</p>
                </div>
            </div>
        @endif

        <div class="section">
            <h2>ℹ️ Informations</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Créée le</span>
                    <span class="info-value">{{ $reservation->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Dernière mise à jour</span>
                    <span class="info-value">{{ $reservation->updated_at->format('d/m/Y à H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="/reservations" class="btn btn-secondary">← Retour à mes réservations</a>
            
            @if($reservation->canBeModified() && $reservation->user_id == auth()->id())
                <a href="/reservations/{{ $reservation->id }}/edit" class="btn btn-primary">✏️ Modifier</a>
            @endif

            @if($reservation->canBeCancelled() && $reservation->user_id == auth()->id())
                <form method="POST" action="/reservations/{{ $reservation->id }}/cancel" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                        ✗ Annuler la réservation
                    </button>
                </form>
            @endif

            @if($reservation->statut == 'active' && $reservation->user_id == auth()->id() && !$reservation->incident_report)
                <button class="btn btn-warning" onclick="openIncidentModal()">⚠️ Signaler un problème</button>
            @endif
        </div>
    </div>

    <div id="incidentModal" class="modal">
        <div class="modal-content">
            <h3>Signaler un incident</h3>
            <form method="POST" action="/reservations/{{ $reservation->id }}/report-incident">
                @csrf
                <div class="form-group">
                    <label>Description du problème</label>
                    <textarea name="incident_report" required placeholder="Décrivez le problème rencontré..."></textarea>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-secondary" onclick="closeIncidentModal()">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openIncidentModal() {
            document.getElementById('incidentModal').classList.add('active');
        }

        function closeIncidentModal() {
            document.getElementById('incidentModal').classList.remove('active');
        }

        document.getElementById('incidentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeIncidentModal();
            }
        });
    </script>
</body>
</html>
