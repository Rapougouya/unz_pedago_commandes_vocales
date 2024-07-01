<!-- resources/views/semestres/edit.blade.php -->
@extends('admin.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier un Semestre</h3>
        </div>
        <div class="card-body">
            <form id="updateForm" action="{{ route('semestres.update', $semestre->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="intitule" class="form-label">Nom du Semestre</label>
                    <input type="text" class="form-control" id="nom" name="intitule" value="{{ $semestre->intitule }}">
                    <button type="button" id="voiceInputBtn" class="btn btn-secondary">🎤 Utiliser la voix</button>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('voiceInputBtn').addEventListener('click', function() {
            // Vérifier si le navigateur supporte l'API Web Speech
            if ('webkitSpeechRecognition' in window) {
                const recognition = new webkitSpeechRecognition();
                recognition.lang = 'fr-FR';
                recognition.start();

                recognition.onresult = function(event) {
                    // Récupérer la transcription du premier résultat
                    const transcript = event.results[0][0].transcript;
                    document.getElementById('nom').value = transcript;

                    // Demander une confirmation vocale
                    const confirmationRecognition = new webkitSpeechRecognition();
                    confirmationRecognition.lang = 'fr-FR';
                    confirmationRecognition.start();

                    confirmationRecognition.onresult = function(event) {
                        const confirmationTranscript = event.results[0][0].transcript.toLowerCase();
                        if (confirmationTranscript.includes('oui')) {
                            document.getElementById('updateForm').submit();
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
    </script>
@endsection
