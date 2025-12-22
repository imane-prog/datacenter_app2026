<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $resources = DB::table('resources')
        ->when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                         ->orWhere('type', 'like', "%{$search}%");
        })
        ->get();

    return view('catalogue', compact('resources'));
}
public function store(Request $request)
{
    DB::table('resources')->insert([
        'nom' => $request->nom,
        'type' => $request->type,
        'statut' => $request->statut,
        'cpu' => $request->cpu,
        'ram' => $request->ram,
        'capacite' => $request->capacite,
        'os' => $request->os,
        'emplacement' => $request->emplacement,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect('/catalogue')->with('success', 'Ressource ajoutée !');
}
// Afficher le formulaire de modification
public function edit($id) {
    $resource = DB::table('resources')->where('id', $id)->first();
    return view('edit', compact('resource'));
}

// Enregistrer les modifications
public function update(Request $request, $id) {
    DB::table('resources')->where('id', $id)->update([
        'nom' => $request->nom,
        'type' => $request->type,
        'statut' => $request->statut,
        'emplacement' => $request->emplacement,
    ]);
    return redirect('/catalogue')->with('success', 'Mise à jour réussie !');
}

// Supprimer une ressource
public function destroy($id) {
    DB::table('resources')->where('id', $id)->delete();
    return redirect('/catalogue')->with('success', 'Ressource supprimée !');
}
}
