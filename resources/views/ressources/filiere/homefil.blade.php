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
                <a class="nav-link" href="{{route('homemod')}}">
                  <i class="mdi mdi-equal-box menu-icon"></i>
                  <span class="menu-title">Module</span>
                </a>
              </li>
              <li class="nav-item active">
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
                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher un module" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Chercher</button>
                  </form>
                </div>


                @if ($filieres->isEmpty())
                <strong>  Aucun résultat trouvé pour la recherche : {{ request('query') }}</strong>
            @endif

              </nav>

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
                        >Listes des modules avec leurs enseignants</a
                      >
                      <a href="{{ route('filieres.create')}}" class="btn btn-outline-info">CREER UNE FILIERE</a>
                      @foreach ($filieres->groupBy('ufr_id') as $ufrId => $groupedFilieres)
                      <div class="card mb-3">
                          <div class="card-body">
                              <h5 class="card-title">Filières pour l'UFR {{ $groupedFilieres->first()->ufr->nom }}</h5>
                              <button class="btn btn-primary toggle-details">Afficher les détails</button>
                              <div class="details" style="display: none;">
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>NOM</th>
                                              <th class="text-end">Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($groupedFilieres as $filiere)
                                              <tr>
                                                  <td>{{ $filiere->id }}</td>
                                                  <td>{{ $filiere->nom }}</td>
                                                  <td>
                                                      <div class="d-flex gap-2 w-100 justify-content-end">
                                                          <a href="{{ route('filieres.edit', $filiere) }}" class="btn btn-primary">MODIFIER</a>
                                                          <form action="{{ route('filieres.destroy', $filiere) }}" method="post">
                                                              @csrf
                                                              @method('delete')
                                                              <button class="btn btn-danger">RETIRER</button>
                                                          </form>
                                                      </div>
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  @endforeach

                  <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Sélectionnez tous les boutons avec la classe "toggle-details"
                        var buttons = document.querySelectorAll(".toggle-details");

                        // Ajoutez un écouteur d'événements à chaque bouton
                        buttons.forEach(function(button) {
                            button.addEventListener("click", function() {
                                // Trouvez le conteneur de détails associé à ce bouton
                                var details = this.nextElementSibling;

                                // Basculer l'affichage des détails
                                if (details.style.display === "none" || details.style.display === "") {
                                    details.style.display = "block";
                                    this.textContent = "Cacher les détails";
                                } else {
                                    details.style.display = "none";
                                    this.textContent = "Afficher les détails";
                                }
                            });
                        });
                    });
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
