<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Vocale</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 120vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background: rgba(18, 18, 18, 0.5);
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: url('/assets/img/micro2.png') no-repeat center center fixed;
            background-size: cover;
            animation: expandBackground 2s ease-out forwards;
            z-index: -1; /* Mettre l'image de fond en arrière-plan */
        }

        @keyframes expandBackground {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .content {
            position: relative;
            z-index: 1; /* Mettre le contenu au-dessus de l'image de fond */
            padding: 20px;
            background: rgba(243, 178, 86, 0.702); /* Fond semi-transparent pour améliorer la lisibilité */
            border-radius: 10px;
            border-color: red;
            text-align: center;
        }

        h1 {
            margin: 0;
            color: #fcfbfd;
            font-size: 2rem;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <h1>VEUILLEZ ENVOYER VOTRE COMMANDE VOCALE</h1>
        <form id="voice-form" action="{{ route('execute.command') }}" method="POST">
            @csrf
            <input type="hidden" name="command" id="voice-command">
        </form>
    </div>

    <script>
        function sendCommandToServer(command) {
            fetch('http://localhost:8000/execute-command', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ command: command }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Redémarrer la reconnaissance vocale après avoir envoyé la commande
                startVoiceCommand();
            })
            .catch(error => console.error('Erreur lors de l\'envoi de la commande:', error));
        }

        // Définition de startVoiceCommand
        function startVoiceCommand() {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();
            recognition.lang = 'fr-FR';

            recognition.onresult = function(event) {
                const command = event.results[0][0].transcript;
                console.log('Commande:', command);
                document.getElementById('voice-command').value = command;
                document.getElementById('voice-form').submit();
            };

            recognition.start();
        }

        // Appeler la fonction startVoiceCommand au chargement de la page
        window.onload = function() {
            startVoiceCommand();
        };
    </script>
</body>
</html>
