@extends('admin.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier un Module</h3>
        </div>
        <div class="card-body">
            <form id="updateForm" action="{{ route('maj', ['module' => $module->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nom" class="col-md-4 col-form-label text-md-right">Nom du module :</label>
                    <div class="col-md-6">
                        <input type="text" id="nom" name="nom" class="form-control" value="{{ $module->nom }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="code" class="col-md-4 col-form-label text-md-right">Code du module :</label>
                    <div class="col-md-6">
                        <input type="text" id="code" name="code" class="form-control" value="{{ $module->code }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="coefficient" class="col-md-4 col-form-label text-md-right">Coefficient :</label>
                    <div class="col-md-6">
                        <input type="text" id="coefficient" name="coefficient" class="form-control" value="{{ $module->coefficient }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="enseignant_id" class="col-md-4 col-form-label text-md-right">Enseignant :</label>
                    <div class="col-md-6">
                        <select id="enseignant_id" name="enseignant_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $module->enseignant_id == $user->id ? 'selected' : '' }}>{{ $user->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" id="submitModuleButton" class="btn btn-primary">Modifier le module</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nomInput = document.getElementById('nom');
            const codeInput = document.getElementById('code');
            const coefficientInput = document.getElementById('coefficient');
            const submitButton = document.getElementById('submitModuleButton');

            function removeAccents(str) {
                const accents = 'ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖØòóôõöøÙÚÛÜùúûüÿÑñÇç';
                const accentsOut = "AAAAAAaaaaaaEEEEeeeeIIIIiiiiOOOOOOooooooUUUUuuuuyNnCc";
                return str.split('').map((letter, index) => {
                    const accentIndex = accents.indexOf(letter);
                    return accentIndex !== -1 ? accentsOut[accentIndex] : letter;
                }).join('');
            }

            function initSpeechRecognition(inputElement) {
                const recognition = new webkitSpeechRecognition();
                recognition.lang = 'fr-FR';

                recognition.onresult = (event) => {
                    let transcript = event.results[0][0].transcript.toLowerCase();
                    transcript = transcript.replace(/arobase/g, '@').replace(/\s+/g, '');
                    transcript = removeAccents(transcript);
                    inputElement.value = transcript;
                };

                recognition.start();
            }

            function setupSpeechRecognitionForInputs() {
                nomInput.addEventListener('focus', () => initSpeechRecognition(nomInput));
                codeInput.addEventListener('focus', () => initSpeechRecognition(codeInput));
                coefficientInput.addEventListener('focus', () => initSpeechRecognition(coefficientInput));
            }

            setupSpeechRecognitionForInputs();

            function listenForSubmitCommand() {
                const recognition = new webkitSpeechRecognition();
                recognition.lang = 'fr-FR';

                recognition.onresult = (event) => {
                    const transcript = event.results[0][0].transcript.toLowerCase();
                    console.log("Transcript:", transcript);
                    if (transcript.includes("modifier le module")) {
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
