<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifier - {{ $resource->nom }}</title>
</head>
<body class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h2>Modifier la ressource : {{ $resource->nom }}</h2>
        </div>
        <div class="card-body">
            <form action="/resources/update/{{ $resource->id }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom de la ressource</label>
                    <input type="text" name="nom" value="{{ $resource->nom }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="Serveur Physique" {{ $resource->type == 'Serveur Physique' ? 'selected' : '' }}>Serveur Physique</option>
                        <option value="Machine Virtuelle" {{ $resource->type == 'Machine Virtuelle' ? 'selected' : '' }}>Machine Virtuelle</option>
                        <option value="Stockage" {{ $resource->type == 'Stockage' ? 'selected' : '' }}>Stockage</option>
                        <option value="Réseau" {{ $resource->type == 'Réseau' ? 'selected' : '' }}>Réseau</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="Disponible" {{ $resource->statut == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Maintenance" {{ $resource->statut == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="Réservé" {{ $resource->statut == 'Réservé' ? 'selected' : '' }}>Réservé</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Emplacement</label>
                    <input type="text" name="emplacement" value="{{ $resource->emplacement }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                <a href="/catalogue" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>