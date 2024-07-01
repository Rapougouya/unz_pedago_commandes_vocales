<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Recognition</title>
</head>
<body>
    <form action="{{ route('test.command') }}" method="POST">
        @csrf
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name">
        <button id="startRecognition">Démarrer la reconnaissance vocale</button>
        <button type="submit">Soumettre</button>
    </form>

    <script>
        const startRecognitionButton = document.getElementById('startRecognition');
        const nameInput = document.getElementById('name');
        const form = document.getElementById('speechForm');

        startRecognitionButton.addEventListener('click', () => {
            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'fr-FR';

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                nameInput.value = transcript;

                // Soumettre le formulaire une fois que le champ est rempli
                form.submit();
            };

            recognition.start();
        });
    </script>
</body>
</html>
