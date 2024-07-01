@extends('admin.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Créer un nouveau Semestre</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('semestres.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="intitule" class="form-label">Nom du Semestre</label>
                <input type="text" class="form-control" id="intitule" name="intitule">
            </div>
            <div class="mb-3">
                <label for="filiere_id" class="form-label">Filière</label>
                <select class="form-control" id="filiere_id" name="filiere_id">
                    <!-- Options de filière à inclure ici -->
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
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
       const intituleInput = document.getElementById('intitule');
const createForm = document.querySelector('form');
const filiereInput = document.getElementById('filiere_id');

function initSpeechRecognition() {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'fr-FR';

    recognition.onresult = (event) => {
        let transcript = event.results[0][0].transcript.toLowerCase(); // Convertir tout en minuscules
        const activeElement = document.activeElement;

        // Convertir la première lettre en majuscule
        transcript = transcript.charAt(0).toUpperCase() + transcript.slice(1);
        
        // Remplir le champ actif avec le texte reconnu
        if (activeElement.id === 'intitule') {
            intituleInput.value = transcript;
        } else if (activeElement.id === 'filiere_id') {
            selectFiliere(transcript);
        }

        // Effectuer une requête POST pour envoyer le texte reconnu au serveur
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

   function selectFiliere(nomFiliere) {
       const lowerCaseNomFiliere = nomFiliere.toLowerCase();

       // Parcourir toutes les options de la liste déroulante
       for (let i = 0; i < filiereInput.options.length; i++) {
        const option = filiereInput.options[i];
           // Vérifiez si le texte de l'option correspond au nom de la filière
           if (option.text.toLowerCase() === lowerCaseNomFiliere) {
               // Sélectionnez l'option correspondante
               filiereInput.selectedIndex = i;
               break; // Sortez de la boucle une fois que l'option est sélectionnée
           
            }
        }
    }
      intituleInput.addEventListener('focus', initSpeechRecognition);
      filiereInput.addEventListener('focus', initSpeechRecognition);

    </script>
    
    
    
@endsection
