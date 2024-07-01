@extends('admin.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>LISTES DE VOS PROGRAMMES Dr {{ $user->nom}} </h1>
    <a href="{{ route('cahierenseignant')}}" class="btn btn-primary">Cahier de Texte</a>
    <a href="{{ route('admin.property.create')}}" class="btn btn-primary"> Ajouter un Programme</a>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <form class="d-flex" role="search" method="GET" action="{{ route('admin.property.recherche')}}">
            <input class="form-control me-2" type="search" name="query" placeholder="Rechercher un programme" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Chercher</button>
        </form>
    </div>

    @if ($properties->isEmpty())
    <strong>  Aucun résultat trouvé pour la recherche : {{ request('query') }}</strong>
    @endif
</nav>

<div class="row mt-3">
    @foreach ($properties as $property)
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Programme du {{ $property->jour_debut }} au {{ $property->jour_fin }}</h5>
                <button type="button" class="btn btn-primary btn-sm" id="showInfo{{ $property->id }}">Afficher les détails</button>
                <div id="info{{ $property->id }}" style="display: none;">
                    <p class="card-text">
                        <strong>Heure:</strong> {{ $property->heure_debut }} - {{ $property->heure_fin }} <br>
                        <strong>Enseignant:</strong> Docteur {{ $property->enseignant }} <br>
                        <strong>Module:</strong> {{ $property->module->nom }} <br>
                        <strong>Année académique :</strong>
@if ($property->annee_academique)
    {{ $property->annee_academique->annee_debut }} - {{ $property->annee_academique->annee_fin }}
@else
    Aucune année académique
@endif
<br>

                        <strong>UFR:</strong> {{ $property->ufr->nom }} <br>
                        <strong>Filiere:</strong> {{ $property->filiere->nom }} <br>

                        <strong>Promotion:</strong> {{ $property->promotion->annee }}<br>

                        <strong>Semestre:</strong> {{ $property->semestre->intitule }} <br>
                        <strong>Bâtiment:</strong> {{ $property->batiment->nom }} <br>
                        <strong>Salle:</strong> {{ $property->salle->nom }} <br>
                        @if (strtolower($property->statut) === 'valide')
                        <strong>Statut:</strong> Validé <i class="bi bi-check-circle-fill text-success"></i>
                        @else
                        <strong>Statut:</strong> Non valide
                        @endif
                    </p>
                    <div class="d-flex justify-content-end">
                        @if (strtolower($property->statut) !== 'valide')


                        <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-primary">EDITER</a>
                        @endif
                        <form action="{{route('admin.property.destroy' , $property)}}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">SUPPRIMER</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>



<script>
    // Afficher les détails lorsqu'on clique sur le bouton "Afficher les détails"
    @foreach ($properties as $property)
    document.getElementById("showInfo{{ $property->id }}").addEventListener("click", function(){
        var info = document.getElementById("info{{ $property->id }}");
        if (info.style.display === "none") {
            info.style.display = "block";
        } else {
            info.style.display = "none";
        }
    });
    @endforeach
</script>
{{$properties->links()}}
@endsection
