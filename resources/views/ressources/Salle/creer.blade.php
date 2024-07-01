@extends('admin.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Créer une nouvelle salle</h3>
        </div>
        <div class="card-body">
            <form id="createForm" action="{{ route('salle.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la salle</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $nomSalle ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="capacite" class="form-label">Capacité de la salle</label>
                    <input type="number" class="form-control" id="capacite" name="capacite" value="{{ $capaciteSalle ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="batiment_id">Bâtiment</label>
                    <select name="batiment_id" id="batiment_id" class="form-control">
                        <option value="{{ $batimentId ?? '' }}">{{ $nomBatiment ?? '' }}</option>
                        <!-- Ajoutez d'autres options de bâtiment ici -->
                        @foreach($batiments as $batiment)
                            <option value="{{ $batiment->id }}">{{ $batiment->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Créer</button>
                </div>
            </form>
            
        </div>
    </div>

    <script>
      const createForm = document.getElementById('createForm');
      const nomInput = document.getElementById('nom');
      const capaciteInput = document.getElementById('capacite');
      const batimentInput = document.getElementById('batiment_id');

// Créer une fonction pour initialiser la reconnaissance vocale
function initSpeechRecognition() {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'fr-FR';

    recognition.onresult = (event) => {
        let transcript = event.results[0][0].transcript.toLowerCase(); // Convertir tout en minuscules
        const activeElement = document.activeElement;

        // Convertir la première lettre en majuscule
        transcript = transcript.charAt(0).toUpperCase() + transcript.slice(1);

        // Remplir le champ actif avec le texte reconnu
        if (activeElement.id === 'nom') {
            nomInput.value = transcript;
        } else if (activeElement.id === 'capacite') {
            capaciteInput.value = transcript;
        } else if (activeElement.id === 'batiment_id') {
            // Sélectionnez le bâtiment correspondant dans le champ de sélection
            selectBatiment(transcript);
        }

        // Effectuer une requête POST pour envoyer la commande au serveur
        fetch('/execute-command', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ command: transcript }) // Envoyer le texte reconnu comme commande
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la requête.');
            }
            // Soumettre le formulaire une fois que le champ est rempli
            createForm.submit();
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    };

    recognition.start(); // Démarrer la reconnaissance vocale
}


// Fonction pour sélectionner un bâtiment par son nom dans le champ de sélection
function selectBatiment(nomBatiment) {
    const lowerCaseNomBatiment = nomBatiment.toLowerCase();

    // Parcourir toutes les options de la liste déroulante
    for (let i = 0; i < batimentInput.options.length; i++) {
        const option = batimentInput.options[i];
        // Vérifiez si le texte de l'option correspond au nom du bâtiment
        if (option.text.toLowerCase() === lowerCaseNomBatiment) {
            // Sélectionnez l'option correspondante
            batimentInput.selectedIndex = i;
            break; // Sortez de la boucle une fois que l'option est sélectionnée
        }
    }
}

// Ajouter des écouteurs d'événements focus aux champs de formulaire
nomInput.addEventListener('focus', initSpeechRecognition);
capaciteInput.addEventListener('focus', initSpeechRecognition);
batimentInput.addEventListener('focus', initSpeechRecognition);
    </script>
@endsection
