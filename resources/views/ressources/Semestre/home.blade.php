<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Page chef department</title>
    <link rel="stylesheet" href="assets_private/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets_private/vendors/base/vendor.bundle.base.css" />
    <link rel="stylesheet" href="assets_private/vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="assets_private/css/style.css" />
    <link rel="shortcut icon" href="assets_private/images/favicon.png" />
    <style>
        body {
            background-image: url('/public/assets/img/unz.jpeg'); /* Mettez le chemin de votre image ici */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
        }

        .btn-custom {
           background-color: white; /* Couleur de fond blanche */
           color: black; /* Couleur du texte */
           font-weight: bold; /* Texte en gras */
           padding: 10px 20px; /* Ajustez le padding si nécessaire */
           border: 1px solid #007bff; /* Optionnel : bordure bleue pour correspondre au style Bootstrap */
           border-radius: 4px; /* Optionnel : pour des coins arrondis */
           text-align: center; /* Centrer le texte */
           text-decoration: none; /* Supprimer la décoration de lien */
           display: inline-block; /* Pour que le padding fonctionne correctement */
           transition: background-color 0.3s ease; /* Transition pour l'effet de survol */
       }

       .btn-custom:hover {
           background-color: #f0f0f0; /* Couleur de fond au survol */
           color: #007bff; /* Couleur du texte au survol */
       }

        .semestre-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .semestre-card {
            flex: 0 0 calc(50% - 20px);
            background-color: rgba(53, 131, 123, 0.526);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .semestre-card h5 {
            margin-top: 0;
        }
        .semestre-card table {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <!-- Navbar code remains unchanged -->
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="assets_private/images/logo.svg" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <img src="assets_private/images/logo-mini.svg" alt="logo" />
                </a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li><a class="btn btn-custom" href="{{ route('commande.index') }}">VOCALE</a></li>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <img src="assets_private/images/faces/face5.jpg" alt="" />
                        @if ($user)
                        <span class="nav-profile-name">{{ $user->nom }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item">
                            <i class="mdi mdi-settings text-primary"></i>
                            <div class="btn btn-primary">Profiles</div>
                        </a>
                        <a class="dropdown-item" href="{{ route('connexion')}}" id="logoutButton">
                            <i class="mdi mdi-logout text-primary"></i>
                            <div class="btn btn-danger">Deconnexion</div>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('chef')}}">
                            <i class="mdi mdi-application menu-icon"></i>
                            <span class="menu-title">Nouveau Programme</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rehome')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('filieres.index')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">Filière</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ues.index')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">U_E_S</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ufrs.index')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">U_F_R</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('semestres.index')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">Semestre</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('homebat')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">Batiment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('salle.index')}}">
                            <i class="mdi mdi-equal-box menu-icon"></i>
                            <span class="menu-title">Salle</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('afficheuser')}}">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title"> Utilisateurs </span>
                        </a>
                    </li>
                </ul>
            </nav>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-end flex-wrap">
                            <div class="me-md-3 me-xl-5">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($user)
                                    <h2>Bienvenue dans votre tableau de bord MR {{ $user->nom }}</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <form class="d-flex" role="search" method="GET" action="{{ route('recherche')}}">
                            <input class="form-control me-2" type="search" name="query" placeholder="Rechercher un module" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Chercher</button>
                        </form>
                    </div>
                    @if ($semestres->isEmpty())
                        <strong> Aucun résultat trouvé pour la recherche : {{ request('query') }}</strong>
                    @endif
                </nav>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body dashboard-tabs p-0">
                            <ul class="nav nav-tabs px-4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                                        Listes des modules avec leurs enseignants
                                    </a>
                                    <a href="{{ route('semestres.create')}}" class="btn btn-outline-info">CREER UN SEMESTRE</a>
                                    <div class="semestre-container">
                                        @foreach ($filieres->groupBy('ufr_id') as $ufrId => $groupedFilieres)
                                            @foreach ($groupedFilieres as $filiere)
                                                <div class="semestre-card">
                                                    <h5>Semestres pour la filière {{ $filiere->nom }}</h5>
                                                    <button class="btn btn-primary toggle-details" data-filiere="{{ strtolower($filiere->nom) }}">Afficher les détails</button>
                                                    <div class="details" style="display: none;">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Nom</th>
                                                                    <th width="280px">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($filiere->semestres as $semestre)
                                                                    <tr>
                                                                        <td>{{ $semestre->id }}</td>
                                                                        <td>{{ $semestre->intitule }}</td>
                                                                        <td>
                                                                            <form action="{{ route('semestres.destroy', $semestre->id) }}" method="POST">
                                                                                <a class="btn btn-primary" href="{{ route('semestres.edit', $semestre->id) }}">Modifier</a>
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".toggle-details");
    buttons.forEach(function(button) {
        button.addEventListener("click", function() {
            const details = this.nextElementSibling;
            toggleDetails(details, this);
        });
    });

    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'fr-FR';

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript.toLowerCase().trim();
        console.log("Transcript:", transcript);

        buttons.forEach(function(button) {
            const filiere = button.getAttribute('data-filiere');
            if (transcript.includes("afficher les détails") && normalizeName(transcript).includes(normalizeName(filiere))) {
                const details = button.nextElementSibling;
                toggleDetails(details, button);
            } else if (transcript.includes("cacher les détails") && normalizeName(transcript).includes(normalizeName(filiere))) {
                const details = button.nextElementSibling;
                toggleDetails(details, button);
            }
        });

        // Ajouter les nouvelles conditions ici
        if (transcript.includes("créer un semestre") || transcript.includes("creer un semestre")) {
            console.log("Redirection vers la création de semestre...");
            recognition.stop();
            window.location.href = "{{ route('semestres.create') }}";
        } else if (transcript.includes('nouveau programme')) {
            window.location.href = '#';
        } else if (transcript.includes('module')) {
            recognition.stop();
            window.location.href = '{{ route('rehome') }}';
        } else if (transcript.includes('filière')) {
            recognition.stop();
            window.location.href = '{{ route('filieres.index') }}';
        } else if (transcript.includes('u_e_s')) {
            recognition.stop();
            window.location.href = '{{ route('ues.index') }}';
        } else if (transcript.includes('u_f_r')) {
            recognition.stop();
            window.location.href = '{{ route('ufrs.index') }}';
        } else if (transcript.includes('semestre')) {
            recognition.stop();
            window.location.href = '{{ route('semestres.index') }}';
        } else if (transcript.includes('bâtiment')) {
            recognition.stop();
            window.location.href = '{{ route('homebat') }}';
        } else if (transcript.includes('salle')) {
            recognition.stop();
            window.location.href = '{{ route('salle.index') }}';
        } else if (transcript.includes('utilisateur')) {
            recognition.stop();
            window.location.href = '{{ route('afficheuser') }}';
        }

        if (transcript.includes("modifier le semestre") || transcript.includes("modifier semestre") || transcript.includes("modifier s")) {
            const { semestreName, filiereName } = extractSemestreAndFiliere(transcript, "modifier");
            console.log("Extracted:", { semestreName, filiereName });
            if (semestreName && filiereName) {
                const semestreId = findSemestreIdByName(semestreName, filiereName);
                if (semestreId) {
                    console.log("Redirection vers la modification de semestre...");
                    recognition.stop();
                    window.location.href = `/semestres/${semestreId}/edit`;
                } else {
                    console.log("Semestre ou filière introuvable.");
                    alert("Semestre ou filière introuvable.");
                }
            }
        }

        if ( transcript.includes("supprimer le semestre") || transcript.includes("supprimer semestre") || transcript.includes("supprimer s")) {
            const { semestreName, filiereName } = extractSemestreAndFiliere(transcript, "supprimer");
            console.log("Extracted for deletion:", { semestreName, filiereName });
            if (semestreName && filiereName) {
                const semestreId = findSemestreIdByName(semestreName, filiereName);
                if (semestreId) {
                    console.log("Confirmation et suppression du semestre...");
                    confirmAndDeleteSemestre(semestreId);
                } else {
                    console.log("Semestre ou filière introuvable pour suppression.");
                    alert("Semestre ou filière introuvable.");
                }
            }
        }

        if (transcript.includes("déconnexion") || transcript.includes("deconnexion")) {
            logout();
        }

        recognition.start();
    };

    recognition.onerror = (event) => {
        console.error('Erreur de reconnaissance vocale:', event.error);
    };

    recognition.onend = () => {
        setTimeout(() => {
            recognition.start();
        }, 100);
    };

    recognition.start();

    function toggleDetails(details, button) {
        if (details.style.display === "none" || details.style.display === "") {
            details.style.display = "block";
            button.textContent = "Cacher les détails";
        } else {
            details.style.display = "none";
            button.textContent = "Afficher les détails";
        }
    }

    function removeAccents(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    function normalizeName(name) {
        return removeAccents(name.trim().toUpperCase());
    }

    function findSemestreIdByName(semestreName, filiereName) {
        const semestres = document.querySelectorAll("tbody tr");
        semestreName = normalizeName(semestreName);
        filiereName = normalizeName(filiereName);
        for (let i = 0; i < semestres.length; i++) {
            const semestre = semestres[i];
            const semestreNom = normalizeName(semestre.querySelector("td:nth-child(2)").textContent);
            const semestreFiliere = normalizeName(semestre.closest(".semestre-card").querySelector("h5").textContent);
            console.log("Comparing:", { semestreNom, semestreFiliere, semestreName, filiereName });
            if (semestreNom.includes(semestreName) && semestreFiliere.includes(filiereName)) {
                return semestre.querySelector("td:first-child").textContent;
            }
        }
        return null;
    }

    function extractSemestreAndFiliere(transcript, action) {
        const match = transcript.match(new RegExp(`${action}\\s+(semestre\\s+\\d+|s\\d+)\\s+pour\\s+(\\w+)`, 'i'));
        if (match) {
            const semestreName = normalizeName(match[1]);
            const filiereName = normalizeName(match[2]);
            return { semestreName, filiereName };
        }
        return { semestreName: null, filiereName: null };
    }

    function confirmAndDeleteSemestre(semestreId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce semestre ?")) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/semestres/${semestreId}`;
            form.style.display = 'none';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';
            form.appendChild(tokenInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function logout() {
        window.location.href = "{{ route('connexion') }}";
    }
});

</script>

<script src="assets_private/vendors/base/vendor.bundle.base.js"></script>
<script src="assets_private/vendors/chart.js/Chart.min.js"></script>
<script src="assets_private/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets_private/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="assets_private/js/off-canvas.js"></script>
<script src="assets_private/js/hoverable-collapse.js"></script>
<script src="assets_private/js/template.js"></script>
<script src="assets_private/js/dashboard.js"></script>
<script src="assets_private/js/data-table.js"></script>
<script src="assets_private/js/jquery.dataTables.js"></script>
<script src="assets_private/js/dataTables.bootstrap4.js"></script>
<script src="assets_private/js/jquery.cookie.js" type="text/javascript"></script>
</body>
</html>
