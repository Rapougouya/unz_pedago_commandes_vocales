@extends('admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer un nouveau module</div>

                    <div class="card-body">
                        <form id="createForm" method="post" action="{{ route('chef.module') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">Nom du module :</label>
                                <div class="col-md-6">
                                    <input type="text" id="nom" name="nom" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Filière :</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="coefficient" class="col-md-4 col-form-label text-md-right">Coefficient :</label>
                                <div class="col-md-6">
                                    <input type="text" id="coefficient" name="coefficient" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="enseignant_id" class="col-md-4 col-form-label text-md-right">Enseignant :</label>
                                <div class="col-md-6">
                                    <select id="enseignant_id" name="enseignant_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="annee_academique_id" class="col-md-4 col-form-label text-md-right">Année académique :</label>
                                <div class="col-md-6">
                                    <select id="annee_academique_id" name="annee_academique_id" class="form-control">
                                        @foreach ($annee_academiques as $annee_academique)
                                            <option value="{{ $annee_academique->id }}">{{ $annee_academique->annee_debut }} - {{ $annee_academique->annee_fin }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="submitModuleButton" class="btn btn-primary">Créer le module</button>
                                    <button type="button" id="voiceInputBtn" class="btn btn-secondary">🎤 Utiliser la voix</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const nomInput = document.getElementById('nom');
    const codeInput = document.getElementById('code');
    const coefficientInput = document.getElementById('coefficient');
    const enseignantSelect = document.getElementById('enseignant_id');
    const anneeAcademiqueSelect = document.getElementById('annee_academique_id');
    const submitButton = document.getElementById('submitModuleButton');

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function removeAccents(str) {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }

    function normalizeYearFormat(year) {
        // Normalize year format to remove spaces
        return year.replace(/\s+/g, '');
    }

    function initSpeechRecognitionForText(inputElement) {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'fr-FR';

        recognition.onresult = (event) => {
            let transcript = event.results[0][0].transcript.trim();
            transcript = capitalizeFirstLetter(transcript);
            inputElement.value = transcript;
        };

        recognition.start();
    }

    function initSpeechRecognitionForSelect(selectElement, optionsArray) {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'fr-FR';

        recognition.onresult = (event) => {
            let transcript = removeAccents(event.results[0][0].transcript.trim().toLowerCase());
            
            // Normalize year format to remove spaces
            transcript = normalizeYearFormat(transcript);

            console.log("Transcript pour sélection:", transcript); // Log for debugging

            // Find the corresponding option in the select
            for (let i = 0; i < optionsArray.length; i++) {
                const normalizedOption = removeAccents(optionsArray[i].toLowerCase()).replace(/\s+/g, '');
                if (normalizedOption.includes(transcript)) {
                    selectElement.selectedIndex = i;
                    console.log("Option sélectionnée:", optionsArray[i]); // Log for debugging
                    break;
                }
            }
        };

        recognition.start();
    }

    function setupSpeechRecognitionForTextInputs() {
        nomInput.addEventListener('focus', () => initSpeechRecognitionForText(nomInput));
        codeInput.addEventListener('focus', () => initSpeechRecognitionForText(codeInput));
        coefficientInput.addEventListener('focus', () => initSpeechRecognitionForText(coefficientInput));
    }

    function setupSpeechRecognitionForSelects() {
        const enseignantOptions = Array.from(enseignantSelect.options).map(option => option.text);
        const anneeAcademiqueOptions = Array.from(anneeAcademiqueSelect.options).map(option => option.text);

        enseignantSelect.addEventListener('focus', () => initSpeechRecognitionForSelect(enseignantSelect, enseignantOptions));
        anneeAcademiqueSelect.addEventListener('focus', () => initSpeechRecognitionForSelect(anneeAcademiqueSelect, anneeAcademiqueOptions));
    }

    setupSpeechRecognitionForTextInputs();
    setupSpeechRecognitionForSelects();

    document.getElementById('voiceInputBtn').addEventListener('click', function() {
        // Vérifier si le navigateur supporte l'API Web Speech
        if ('webkitSpeechRecognition' in window) {
            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'fr-FR';
            recognition.start();

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript.trim();
                document.activeElement.value = transcript;

                const confirmationRecognition = new webkitSpeechRecognition();
                confirmationRecognition.lang = 'fr-FR';
                confirmationRecognition.start();

                confirmationRecognition.onresult = function(event) {
                    const confirmationTranscript = event.results[0][0].transcript.toLowerCase();
                    if (confirmationTranscript.includes('oui')) {
                        document.getElementById('createForm').submit();
                    } else if (confirmationTranscript.includes('non')) {
                        alert("Soumission annulée");
                    } else {
                        alert("Réponse non reconnue, veuillez dire 'oui' ou 'non'");
                    }
                };

                confirmationRecognition.onerror = function(event) {
                    console.error(event.error);
                };
            };

            recognition.onerror = function(event) {
                console.error(event.error);
            };
        } else {
            alert("Votre navigateur ne supporte pas la reconnaissance vocale.");
        }
    });

    function listenForSubmitCommand() {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'fr-FR';

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript.toLowerCase();
            console.log("Transcript:", transcript);
            if (transcript.includes("créer")) {
                submitButton.click();
            }
        };

        recognition.onerror = (event) => {
            console.error('Erreur de reconnaissance vocale:', event.error);
        };

        recognition.onend = () => {
            setTimeout(() => {
                recognition.start();
            }, 10000); // Redémarrage de la reconnaissance après 10 secondes
        };

        recognition.start();
    }

    listenForSubmitCommand();
});


    </script>
@endsection
