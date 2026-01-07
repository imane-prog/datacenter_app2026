<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Réservation - Data Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-error ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group label span {
            color: #dc3545;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: #666;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .resource-preview {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .resource-preview h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .resource-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .conflict-alert {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .conflict-alert h4 {
            color: #856404;
            margin-bottom: 10px;
        }

        .conflict-item {
            padding: 10px;
            background: white;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 13px;
        }

        .error-text {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Nouvelle Réservation</h1>
            <p class="subtitle">Remplissez le formulaire pour demander une réservation de ressource</p>
        </div>

        @if(session('error'))
            <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif

        @if(session('conflicts'))
            <div class="conflict-alert">
                <h4>⚠️ Conflit de réservation détecté</h4>
                <p>Cette ressource est déjà réservée pour les périodes suivantes :</p>
                @foreach(session('conflicts') as $conflict)
                    <div class="conflict-item">
                        <strong>{{ $conflict->user->name }}</strong> - 
                        Du {{ $conflict->date_debut->format('d/m/Y') }} 
                        au {{ $conflict->date_fin->format('d/m/Y') }}
                        ({{ $conflict->getStatusText() }})
                    </div>
                @endforeach
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>✗ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/reservations/store">
            @csrf

            <div class="form-group">
                <label>Ressource <span>*</span></label>
                <select name="resource_id" id="resourceSelect" required>
                    <option value="">-- Sélectionnez une ressource --</option>
                    @foreach($resources as $resource)
                        <option value="{{ $resource->id }}" 
                                {{ (old('resource_id') == $resource->id || ($selectedResource && $selectedResource->id == $resource->id)) ? 'selected' : '' }}
                                data-nom="{{ $resource->nom }}"
                                data-type="{{ $resource->type }}"
                                data-cpu="{{ $resource->cpu }}"
                                data-ram="{{ $resource->ram }}"
                                data-capacite="{{ $resource->capacite }}"
                                data-os="{{ $resource->os }}">
                            {{ $resource->nom }} ({{ $resource->type }})
                        </option>
                    @endforeach
                </select>
                @error('resource_id')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div id="resourcePreview" style="display: none;">
                <div class="resource-preview">
                    <h3>Détails de la ressource</h3>
                    <div class="resource-info">
                        <div class="info-item">
                            <span class="info-label">Type</span>
                            <span class="info-value" id="previewType">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CPU</span>
                            <span class="info-value" id="previewCpu">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">RAM</span>
                            <span class="info-value" id="previewRam">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Capacité</span>
                            <span class="info-value" id="previewCapacite">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date de début <span>*</span></label>
                    <input type="date" name="date_debut" value="{{ old('date_debut') }}" 
                           min="{{ date('Y-m-d') }}" required>
                    @error('date_debut')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Date de fin <span>*</span></label>
                    <input type="date" name="date_fin" value="{{ old('date_fin') }}" 
                           min="{{ date('Y-m-d') }}" required>
                    @error('date_fin')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Heure de début (optionnel)</label>
                    <input type="time" name="heure_debut" value="{{ old('heure_debut') }}">
                    <small>Laissez vide pour toute la journée</small>
                </div>

                <div class="form-group">
                    <label>Heure de fin (optionnel)</label>
                    <input type="time" name="heure_fin" value="{{ old('heure_fin') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Justification <span>*</span></label>
                <textarea name="justification" required placeholder="Expliquez pourquoi vous avez besoin de cette ressource (minimum 10 caractères)">{{ old('justification') }}</textarea>
                @error('justification')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description complémentaire</label>
                <textarea name="description" placeholder="Informations supplémentaires sur votre utilisation...">{{ old('description') }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                <a href="/reservations" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <script>
        const resourceSelect = document.getElementById('resourceSelect');
        const resourcePreview = document.getElementById('resourcePreview');

        resourceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                document.getElementById('previewType').textContent = selectedOption.dataset.type || '-';
                document.getElementById('previewCpu').textContent = selectedOption.dataset.cpu || '-';
                document.getElementById('previewRam').textContent = selectedOption.dataset.ram || '-';
                document.getElementById('previewCapacite').textContent = selectedOption.dataset.capacite || '-';
                resourcePreview.style.display = 'block';
            } else {
                resourcePreview.style.display = 'none';
            }
        });

        if (resourceSelect.value) {
            resourceSelect.dispatchEvent(new Event('change'));
        }
    </script>
</body>
</html>
