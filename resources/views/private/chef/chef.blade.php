<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Page chef department</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets_private/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets_private/vendors/base/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="assets_private/vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets_private/css/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="assets_private/images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="assets_private/images/logo.svg" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets_private/images/logo-mini.svg" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li><a class="btn btn-primary" href="{{ route('commande.index') }}">VOCALE</a></li>
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
                            <a class="dropdown-item" href="{{ route('connexion')}}">
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
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- 2eme navbar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
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
                    <li class="nav-item">
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
                            <span class="menu-title">Gestions des utilisateurs </span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- fin de la deuxieme nav bar-->
            <!-- la partie de bienvenue -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
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
                                        <h2>Bienvenue dans votre tableau de bord MR {{ $user->nom}}</h2> 
                                        @else
                                        <h2>Bienvenue dans votre tableau de bord</h2> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin de bienvenue -->
                    <!-- partie de evenement catégorie et utilisateur -->
                    <nav class="navbar bg-body-tertiary">
                        <div class="container-fluid">
                            <form class="d-flex" role="search" method="GET" action="{{ route('recherche')}}">
                                <input class="form-control me-2" type="search" name="query" placeholder="Rechercher un programme" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Chercher</button>
                            </form>
                        </div>
                        @if ($properties->isEmpty())
                        <strong>  Aucun résultat trouvé pour la recherche : {{ request('query') }}</strong>
                        @endif
                    </nav>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <ul class="nav nav-tabs px-4" role="tablist">
                                        <li class="nav-item">
                                            <div class="row mt-3">
                                                @foreach ($properties as $property)
                                                <div class="col-md-6">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Programme du {{ $property->jour_debut }} au {{ $property->jour_fin }} de <strong>Annee_academique:</strong> {{ $property->annee_academique->annee }}
                                                                <strong>Programme Numero:</strong> {{ $property->id }} <br>
                                                            </h5>
                                                            <button type="button" class="btn btn-primary btn-sm" onclick="toggleDetails('{{ $property->id }}')" id="showInfo{{ $property->id }}">Afficher les détails</button>
                                                            <div id="info{{ $property->id }}" style="display: none;">
                                                                <p class="card-text">
                                                                    <strong>Heure:</strong> {{ $property->heure_debut }} - {{ $property->heure_fin }} <br>
                                                                    <strong>Enseignant:</strong> Docteur {{ $property->enseignant }} <br>
                                                                    <strong>Module:</strong> {{ $property->module->libelle }} <br>
                                                                    <strong>Filière:</strong> {{ $property->filiere->libelle }} <br>
                                                                    <strong>Salle:</strong> {{ $property->salle ? $property->salle->nom : 'N/A' }} <br>
                                                                    <strong>Jour de la semaine:</strong> {{ $property->jour ? $property->jour->nom : 'N/A' }} <br>
                                                                    <strong>Semestre:</strong> {{ $property->semestre ? $property->semestre->libelle : 'N/A' }} <br>
                                                                </p>
                                                                <form action="#" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce programme?')">
                                                                    <a href="#" class="btn btn-info btn-sm">Editer</a>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            {{ $properties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function toggleDetails(id) {
                const infoDiv = document.getElementById(`info${id}`);
                const showInfoButton = document.getElementById(`showInfo${id}`);

                if (infoDiv.style.display === 'none') {
                    infoDiv.style.display = 'block';
                    showInfoButton.textContent = 'Masquer les détails';
                } else {
                    infoDiv.style.display = 'none';
                    showInfoButton.textContent = 'Afficher les détails';
                }
            }

            document.addEventListener('DOMContentLoaded', (event) => {
                if ('webkitSpeechRecognition' in window) {
                    const recognition = new webkitSpeechRecognition();
                    recognition.continuous = true;
                    recognition.interimResults = false;
                    recognition.lang = 'fr-FR';

                    recognition.onstart = () => {
                        console.log('La reconnaissance vocale a commencé.');
                    };

                    recognition.onresult = (event) => {
                        const transcript = event.results[event.results.length - 1][0].transcript.trim().toLowerCase();
                        console.log('Résultat de la reconnaissance vocale : ', transcript);

                        if (transcript.includes('nouveau programme')) {
                            window.location.href = '#';
                        } else if (transcript.includes('module')) {
                            window.location.href = '{{route('rehome')}}';
                        } else if (transcript.includes('filière')) {
                            window.location.href = '{{route('filieres.index')}}';
                        } else if (transcript.includes('u_e_s')) {
                            window.location.href = '{{route('ues.index')}}';
                        } else if (transcript.includes('u_f_r')) {
                            window.location.href = '{{route('ufrs.index')}}';
                        } else if (transcript.includes('semestre')) {
                            window.location.href = '{{route('semestres.index')}}';
                        } else if (transcript.includes('bâtiment')) {
                            window.location.href = '{{route('homebat')}}';
                        } else if (transcript.includes('salle')) {
                            window.location.href = '{{route('salle.index')}}';
                        } else if (transcript.includes('utilisateur')) {
                            window.location.href = '{{route('afficheuser')}}';
                        }
                    };

                    recognition.onerror = (event) => {
                        console.error('Erreur de reconnaissance vocale : ', event.error);
                    };

                    recognition.onend = () => {
                        console.log('La reconnaissance vocale est terminée.');
                        // Restart recognition after it ends
                        recognition.start();
                    };

                    recognition.start();
                } else {
                    console.warn('La reconnaissance vocale n\'est pas supportée par ce navigateur.');
                }
            });
        </script>
    </div>
</body>
</html>
