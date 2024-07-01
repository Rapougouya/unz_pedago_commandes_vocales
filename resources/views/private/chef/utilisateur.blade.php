<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Page chef department</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets_private/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets_private/vendors/base/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="assets_private/vendors/datatables.net-bs4/dataTables.bootstrap4.css"
    />
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
          <div
            class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"
          >
            <a class="navbar-brand brand-logo" href="index.html"
              ><img src="assets_private/images/logo.svg" alt="logo"
            /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"
              ><img src="assets_private/images/logo-mini.svg" alt="logo"
            /></a>
            <button
              class="navbar-toggler navbar-toggler align-self-center"
              type="button"
              data-toggle="minimize"
            >
              <span class="mdi mdi-sort-variant"></span>
            </button>
          </div>
        </div>
        <div
          class="navbar-menu-wrapper d-flex align-items-center justify-content-end"
        >

          <ul class="navbar-nav navbar-nav-right">
            <li><a class="btn btn-primary" href="{{ route('commande.index') }}">VOCALE</a></li>
           <li class="nav-item nav-profile dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                data-bs-toggle="dropdown"
                id="profileDropdown"
              >
                <img src="assets_private/images/faces/face5.jpg" alt="" />
                @if ($user)
                <span class="nav-profile-name">{{ $user->nom}}</span>
                @endif
              </a>
              <div
                class="dropdown-menu dropdown-menu-right navbar-dropdown"
                aria-labelledby="profileDropdown"
              >
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
          <button
            class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-toggle="offcanvas"
          >
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- 2eme navbar -->

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">


            <li class="nav-item ">
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
                <a class="nav-link" href="#">
                  <i class="mdi mdi-equal-box menu-icon"></i>
                  <span class="menu-title">U_E_S</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-equal-box menu-icon"></i>
                  <span class="menu-title">U_F_R</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
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
            <li class="nav-item active">
                <a class="nav-link" href="">
                  <i class="mdi mdi-account-multiple menu-icon"></i>
                  <span class="menu-title">Gestion des  utilisateurs</span>
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
                        <h2>Bienvenue dans la gestion des utilisateurs MR {{ $user->nom}}</h2> 
                        @endif
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- fin de bienvenue -->

            <!-- partie de evenement catégorie et utilisateur -->

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                      <li class="nav-item">
                        <a
                          class="nav-link active"
                          id="overview-tab"
                          data-bs-toggle="tab"
                          href="#overview"
                          role="tab"
                          aria-controls="overview"
                          aria-selected="true"
                          >Informations sur les utilisateurs</a
                        >
                        <a href="{{ route('creer')}}" class="btn btn-success"> Ajouter enseignant</a>
                        <a href="{{ route('creer_etudiant') }}" class="btn btn-secondary"> Ajouter étudiant/chefdepart</a>

                        <div class="row mt-3">
                            @foreach ($users as $user)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $user->prenom }} {{ $user->nom }} </h5>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="toggleDetails('{{ $user->id }}')" id="showInfo{{ $user->id }}">Afficher les détails</button>
                                        <div id="info{{ $user->id }}" style="display: none;">
                                            <p class="card-text">
                                                <strong>Nom:</strong> {{ $user->nom }}<br>
                                                <strong>Prenom:</strong> {{ $user->prenom }}<br>
                                                <strong>Email:</strong> {{ $user->email }} <br>
                                                <strong>Matricule:</strong> {{ $user->ine }} <br>
                                                <strong>Téléphone:</strong> {{ $user->telephone }} <br>
                                                <strong>Rôle:</strong> {{ $user->role }} <br>
                                                <strong>Module Associé:</strong>
                                                @if ($user->modules->isNotEmpty())
                                                    {{ $user->modules->first()->nom }} <!-- Afficher le premier module associé -->
                                                @else
                                                    Aucun module associé
                                                @endif
                                            </p>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('editer', $user) }}" class="btn btn-primary">MODIFIER</a>
                                                <form action="{{ route('supprimer', $user) }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button class="btn btn-danger">RETIRER</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <script>
                            // Fonction pour afficher/cacher les détails
                            function toggleDetails(id) {
                                var x = document.getElementById("info" + id);
                                if (x.style.display === "none") {
                                    x.style.display = "block";
                                    document.getElementById("showInfo" + id).textContent = "Cacher les détails";
                                } else {
                                    x.style.display = "none";
                                    document.getElementById("showInfo" + id).textContent = "Afficher les détails";
                                }
                            }
                        </script>

                      </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                      <div
                        class="tab-pane fade show active"
                        id="overview"
                        role="tabpanel"
                        aria-labelledby="overview-tab"
                      >

                  </div>
                </div>
              </div>
            </div>

            <!-- fin de evenement cathégorie et utilisateur -->

            <!-- évènement récent -->

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">

          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="assets_private/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="assets_private/vendors/chart.js/Chart.min.js"></script>
    <script src="assets_private/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets_private/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="assets_private/js/off-canvas.js"></script>
    <script src="assets_private/js/hoverable-collapse.js"></script>
    <script src="assets_private/js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets_private/js/dashboard.js"></script>
    <script src="assets_private/js/data-table.js"></script>
    <script src="assets_private/js/jquery.dataTables.js"></script>
    <script src="assets_private/js/dataTables.bootstrap4.js"></script>
    <!-- End custom js for this page-->

    <script src="assets_private/js/jquery.cookie.js" type="text/javascript"></script>
  </body>
</html>
