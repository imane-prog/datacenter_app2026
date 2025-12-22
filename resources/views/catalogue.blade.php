<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Catalogue Datacenter</title>
</head>
<body class="container mt-5">
    <h1 class="mb-4 text-primary">📦 Catalogue des Ressources Datacenter</h1>
    <table class="table table-striped table-hover shadow">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Statut</th>
                <th>CPU / RAM</th>
                <th>Emplacement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resources as $resource)
            <tr>
                <td class="fw-bold">{{ $resource->nom }}</td>
                <td><span class="badge bg-secondary">{{ $resource->type }}</span></td>
                <td>
                    <span class="badge {{ $resource->statut == 'Disponible' ? 'bg-success' : ($resource->statut == 'Maintenance' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $resource->statut }}
                    </span>
                </td>
                <td>{{ $resource->cpu }} / {{ $resource->ram }}</td>
                <td>{{ $resource->emplacement }}</td>
                <td>
    <a href="/resources/show/{{ $resource->id }}" class="btn btn-sm btn-info text-white">Voir</a>
    
    <a href="/resources/edit/{{ $resource->id }}" class="btn btn-sm btn-warning">Modifier</a>
    <a href="/resources/delete/{{ $resource->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    <form action="/catalogue" method="GET" class="mb-4 d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un serveur ou un type..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Rechercher</button>
    <a href="/catalogue" class="btn btn-outline-secondary ms-2">Réinitialiser</a>
</form>
<hr>
<h3 class="mt-5">Ajouter une nouvelle ressource</h3>
<form action="/resources/store" method="POST" class="row g-3 p-4 bg-light border rounded">
    @csrf
    <div class="col-md-4"><input type="text" name="nom" class="form-control" placeholder="Nom (ex: SRV-02)" required></div>
    <div class="col-md-4">
        <select name="type" class="form-select">
            <option value="Serveur Physique">Serveur Physique</option>
            <option value="Machine Virtuelle">Machine Virtuelle</option>
            <option value="Stockage">Stockage</option>
        </select>
    </div>
    <div class="col-md-4">
        <select name="statut" class="form-select">
            <option value="Disponible">Disponible</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Réservé">Réservé</option>
        </select>
    </div>
    <div class="col-md-3"><input type="text" name="cpu" class="form-control" placeholder="CPU"></div>
    <div class="col-md-3"><input type="text" name="ram" class="form-control" placeholder="RAM"></div>
    <div class="col-md-3"><input type="text" name="os" class="form-control" placeholder="Système (OS)"></div>
    <div class="col-md-3"><input type="text" name="emplacement" class="form-control" placeholder="Emplacement" required></div>
    <div class="col-12"><button type="submit" class="btn btn-success w-100">Enregistrer la ressource</button></div>
</form>
</body>
</html>