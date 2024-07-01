<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <!-- Formulaire d'inscription -->
    <form id="inscriptionForm" action="{{ route('inscripte') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom">
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom">
        </div>
        <!-- Autres champs du formulaire ici -->
        <button id="startRecording">Démarrer l'enregistrement vocal</button>
        <button type="submit">Soumettre</button>
    </form>

    <script>
        const startRecordingButton = document.getElementById('startRecording');
        const inscriptionForm = document.getElementById('inscriptionForm');

        startRecordingButton.addEventListener('click', async () => {
            try {
                const mediaStream = await navigator.mediaDevices.getUserMedia({ audio: true });
                const mediaRecorder = new MediaRecorder(mediaStream);
                let audioChunks = [];

                mediaRecorder.addEventListener('dataavailable', event => {
                    audioChunks.push(event.data);
                });

                mediaRecorder.addEventListener('stop', async () => {
                    const audioBlob = new Blob(audioChunks);
                    const formData = new FormData();
                    formData.append('audio', audioBlob);

                    try {
                        const response = await fetch('/reconnaissance-vocale', {
                            method: 'POST',
                            body: formData
                        });
                        const data = await response.json();

                        // Remplir les champs du formulaire avec le texte reconnu
                        inscriptionForm.nom.value = data.nom;
                        inscriptionForm.prenom.value = data.prenom;
                        // Répétez pour les autres champs du formulaire
                    } catch (error) {
                        console.error('Erreur lors de la reconnaissance vocale:', error);
                    }
                });

                mediaRecorder.start();

                setTimeout(() => {
                    mediaRecorder.stop();
                }, 5000); // Arrête l'enregistrement après 5 secondes
            } catch (error) {
                console.error('Erreur lors de la capture audio:', error);
            }
        });
    </script>

</body>
</html>
