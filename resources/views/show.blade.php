<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Fiche Détail - {{ $resource->nom }}</title>
</head>
<body class="container mt-5">
    <div class="card shadow border-info">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0">🔍 Fiche détaillée : {{ $resource->nom }}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 border-end">
                    <h5 class="text-primary">Informations Générales</h5>
                    <p><strong>Type :</strong> {{ $resource->type }}</p>
                    <p><strong>Statut :</strong> <span class="badge bg-success">{{ $resource->statut }}</span></p>
                    <p><strong>Emplacement :</strong> {{ $resource->emplacement }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary">Spécifications Techniques</h5>
                    <p><strong>CPU :</strong> {{ $resource->cpu }}</p>
                    <p><strong>RAM :</strong> {{ $resource->ram }}</p>
                    <p><strong>OS :</strong> {{ $resource->os }}</p>
                </div>
            </div>
            <hr>
            <h5 class="text-secondary">Historique des réservations</h5>
            <div class="alert alert-light border">
                📅 22/12/2025 : Installation initiale du système par l'équipe infrastructure.
            </div>
            <a href="/catalogue" class="btn btn-outline-primary mt-3">Retour au catalogue</a>
        </div>
    </div>
</body>
</html>