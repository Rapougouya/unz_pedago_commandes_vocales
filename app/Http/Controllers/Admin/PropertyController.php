<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\Module;
use App\Models\Salle;
use App\Models\Batiment;
use App\Models\Ufr;
Use App\Models\Filiere;
Use App\Models\Promotion;
Use App\Models\Semestre;
use App\Models\AnneeAcademique;
use App\Http\Requests\PropertyFormRequest;
use Illuminate\Support\Facades\Validator;
use App\Imports\ModeleImport;
use App\Services\TelegramService;// Importez la classe Validator
use Telegram\Bot\Laravel\Facades\Telegram;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'utilisateur connecté
    $user = Auth::user();
    $annee_academiques = AnneeAcademique::all();

    // Récupérer les propriétés associées à l'utilisateur connecté
    $properties = $user->properties()->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.properties.index', compact('properties','annee_academiques', 'user'));

        $properties = Property::orderBy('created_at', 'desc')->paginate(10);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semestres = collect();
        $batiments = Batiment::all();
        $filieres = Filiere::all();
        $promotions = Promotion::with('anneesAcademiques')->get();
        $annee_academiques = AnneeAcademique::all();
        $user = Auth::user();
        $salles = Salle::all();
        $ufrs = Ufr::with('filieres')->get();

// Parcourir chaque filière
foreach ($filieres as $filiere) {
    // Récupérer les semestres distincts liés à cette filière
    $semestres = $semestres->merge($filiere->semestres);
}
$semestres = $semestres->unique();
        return view('admin.properties.form', compact('batiments', 'salles', 'annee_academiques', 'ufrs', 'filieres','semestres','promotions'), ['property' => new Property(), 'user' => $user]);
    }




    public function edit(Property $property)
    {
        // Code pour afficher le formulaire d'édition d'une propriété spécifique (à faire)
         // Récupérer l'utilisateur connecté
            $user = Auth::user();
            $semestres = Semestre:: all();
            $filieres = Filiere::all();
            $promotions = Promotion::with('anneesAcademiques')->get();
            $salles = Salle::all();
            $ufrs = Ufr::all();
            $batiments = Batiment::all();
            $annee_academiques = AnneeAcademique::all();
            // Passer l'utilisateur à la vue


            return view('admin.properties.form', compact('batiments','salles','annee_academiques','ufrs','filieres','semestres','promotions'),['property' => $property, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $request->validate([
             'jour_debut' => 'required',
             'jour_fin' => 'required',
             'heure_debut' => 'required',
             'heure_fin' => 'required',
             'enseignant' => 'required',
             'ufr_id' => 'required',
             'filiere_id' => 'required',
             'promotion_id' => 'required',
             'semestre_id' => 'required',
             'batiment_id' => 'required',
             'salle_id' => 'required',
             'module_id' => 'required',
             'user_id' => 'required',
             'annee_academique_id' => 'required',
         ]);

         // Création d'une nouvelle propriété
         $property = new Property();

         $property->jour_debut = $request->jour_debut;
         $property->jour_fin = $request->jour_fin;
         $property->heure_debut = $request->heure_debut;
         $property->heure_fin = $request->heure_fin;
         $property->enseignant = $request->enseignant;
         $property->ufr_id = $request->ufr_id;
         $property->filiere_id = $request->filiere_id;
         $property->promotion_id = $request->promotion_id;
         $property->semestre_id = $request->semestre_id;
         $property->batiment_id = $request->batiment_id;
         $property->salle_id = $request->salle_id;
         $property->module_id = $request->module_id;
         $property->user_id = $request->user_id;
         $property->annee_academique_id = $request->annee_academique_id;
         $property->save();

         // Extraire les informations supplémentaires pour la notification
         $propertyjour_debut = $property->jour_debut;
         $propertyjour_fin = $property->jour_fin;
         $propertyheure_debut = $property->heure_debut;
         $propertyheure_fin = $property->heure_fin;
         $propertymodule_id = $property->module->nom;
         $propertyufr = $property->ufr->nom; // Suppose que le modèle UFR a une propriété nom
         $propertyfiliere = $property->filiere->nom; // Suppose que le modèle Filiere a une propriété nom
         $propertypromotion = $property->promotion->annee;
         $propertyenseignant = $property->enseignant;
         $propertysemestre = $property->semestre->intitule;
         $propertybatiment_id = $property->batiment->nom;
         $propertysalle_id = $property->salle->nom;
         $propertyuser_id = $property->user_id;
         $propertyannee_academique_debut = $property->annee_academique->annee_debut;
         $propertyannee_academique_fin = $property->annee_academique->annee_fin;

         // Envoi de la notification à l'enseignant via Telegram
         Telegram::sendMessage([
             "chat_id" => env('TELEGRAM_CHAT_ID', ''),
             "parse_mode" => 'HTML',
             "text" => "Bonjour Dr $propertyenseignant,

                Vous avez un nouveau programme du <b>$propertyjour_debut</b> au <b>$propertyjour_fin</b> avec les details ci_dessous

             - Année académique : <b>$propertyannee_academique_debut - $propertyannee_academique_fin</b>:

             - Heure de début : <b>$propertyheure_debut</b>

             - Heure de fin : <b>$propertyheure_fin</b>

             - Module : <b>$propertymodule_id</b>

             - UFR : <b>$propertyufr</b>

             - Filière : <b>$propertyfiliere</b>

             - Semestre : <b>$propertysemestre</b>

             - Bâtiment : <b>$propertybatiment_id</b>

             - Salle : <b>$propertysalle_id</b>

             - Promotion : <b>$propertypromotion</b>


             Vous pouvez toujours modifier votre programme avant la validation.

             Cordialement, UNZ_PEDAGO"
         ]);

         return redirect()->route('admin.property.index')->with('success', 'Un nouveau Programme a été ajouté avec succès!');
     }

     public function update(Request $request, Property $property)
     {
        $request->validate([
            'jour_debut' => 'required',
            'jour_fin' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'enseignant' => 'required',
            'ufr_id' => 'required',
            'filiere_id' => 'required',
            'promotion_id' => 'required',
            'semestre_id' => 'required',
            'batiment_id' => 'required',
            'salle_id' => 'required',
            'module_id' => 'required',
            'user_id' => 'required',
            'annee_academique_id' => 'required',
        ]);

        // Mettre à jour les données de la propriété
        $property->update($request->all());

        // Extraire les informations supplémentaires pour la notification
        $propertyjour_debut = $property->jour_debut;
        $propertyjour_fin = $property->jour_fin;
        $propertyheure_debut = $property->heure_debut;
        $propertyheure_fin = $property->heure_fin;
        $propertymodule_id = $property->module->nom;
        $propertyufr = $property->ufr->nom;
        $propertyfiliere = $property->filiere->nom;
        $propertypromotion = $property->promotion->annee;
        $propertyenseignant = $property->enseignant;
        $propertysemestre = $property->semestre->intitule;
        $propertybatiment_id = $property->batiment->nom;
        $propertysalle_id = $property->salle->nom;
        $propertyuser_id = $property->user_id;
        $propertyannee_academique_debut = $property->annee_academique->annee_debut;
        $propertyannee_academique_fin = $property->annee_academique->annee_fin;

        // Envoi de la notification à l'enseignant via Telegram
        Telegram::sendMessage([
            "chat_id" => env('TELEGRAM_CHAT_ID', ''),
            "parse_mode" => 'HTML',
            "text" => "Bonjour Dr $propertyenseignant,

                 Votre programme du <b>$propertyjour_debut</b> au <b>$propertyjour_fin</b> est mis jour avec succès aux cours de

             - Année académique : <b>$propertyannee_academique_debut - $propertyannee_academique_fin</b>

             - Heure de début : <b>$propertyheure_debut</b>

             - Heure de fin : <b>$propertyheure_fin</b>

             - Module : <b>$propertymodule_id</b>

             - UFR : <b>$propertyufr</b>

             - Filière : <b>$propertyfiliere</b>

             - Semestre : <b>$propertysemestre</b>

             - Bâtiment : <b>$propertybatiment_id</b>

             - Salle : <b>$propertysalle_id</b>

             - Promotion : <b>$propertypromotion</b>

             Vous pouvez toujours modifier votre programme avant la validation.

             Cordialement, UNZ_PEDAGO"
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.property.index')->with('success', 'Le Programme a été mis à jour avec succès !');
    }

public function recherche(Request $request)
    {
        $user = Auth::user();

        $query = $request->input('query');

        $properties = Property::where('filiere', 'LIKE', '%' . $query . '%')
        ->orWhere('promotion', 'LIKE', '%' . $query . '%')
        ->orWhere('enseignant', 'LIKE', '%' . $query . '%')
        ->orWhere('ufr', 'LIKE', '%' . $query . '%')
        ->orWhere('semestre', 'LIKE', '%' . $query . '%')
        ->orWhere('lieu', 'LIKE', '%' . $query . '%')
        //->orWhere('module', 'LIKE', '%' . $query . '%')
        ->paginate();

        return view('admin.properties.index', compact('properties') ,  ['user' => $user]);
    }
    public function statut($id)
    {

        $property = Property::findOrFail($id);
        if ($property) {
            $property->update(['statut' => 'valide']);
        }
        $propertyjour_debut = $property->jour_debut;
        $propertyjour_fin = $property->jour_fin;
        $propertyheure_debut = $property->heure_debut;
   $propertyheure_fin = $property->heure_fin;
        $propertymodule_id = $property->module->nom;
        $propertyufr = $property->ufr->nom;
        $propertyfiliere = $property->filiere->nom;
        $propertypromotion = $property->promotion->annee;
        $propertyenseignant = $property->enseignant;
        $propertysemestre = $property->semestre->intitule;
   $propertybatiment_id = $property->batiment->nom;
   $propertysalle_id = $property->salle->nom;
   $propertyuser_id = $property->user_id;
   $propertyannee_academique_id = $property->annee_academique->annee;
   Telegram::sendMessage([
    "chat_id" => env('TELEGRAM_CHAT_ID', ''),
    "parse_mode" => 'HTML',
    "text" => "Bonjour Dr $propertyenseignant,

    Votre programme du <b>$propertyjour_debut</b> au <b>$propertyjour_fin</b> a été validé par le chef de département avec success vérifier les details ci dessous :Année académique :<b>$propertyannee_academique_debut - $propertyannee_academique_fin</b>

    - Heure de début : <b>$propertyheure_debut</b>

    - Heure de fin : <b>$propertyheure_fin</b>

    - Module : <b>$propertymodule_id</b>

    - UFR : <b>$propertyufr</b>

    - Filière : <b>$propertyfiliere</b>

    - Semestre : <b>$propertysemestre</b>

    - Bâtiment : <b>$propertybatiment_id</b>

    - Salle : <b>$propertysalle_id</b>

    - Promotion : <b>$propertypromotion</b>

    Vous pouvez retirer le programme dans le tableau d' affichage

    Cordialement, UNZ_PEDAGO"
]);

        return redirect()->back()->with('success', ' Programme validé avec succès!');
    }

public function module(Request $request)
{
    // Valider les données soumises par le formulaire
    $request->validate([
        'nom' => 'required|string',
        'code' => 'required|string',
        'coefficient' => 'required|numeric',
        'enseignant_id' => 'required|exists:users,id',
        'annee_academique_id' => 'required|exists:annee_academiques,id',
    ]);

    // Créer une nouvelle instance de Module et attribuer les valeurs soumises
    $module = new Module();
    $module->nom = $request->nom;
    $module->code = $request->code;
    $module->coefficient = $request->coefficient;
     // Récupérer l'année académique associée au module
     $annee_academique = AnneeAcademique::findOrFail($request->annee_academique_id);
     // Assigner l'année académique au module
     $module->annee_academique()->associate($annee_academique);

    // Récupérer l'utilisateur enseignant associé au module
    $enseignant = User::findOrFail($request->enseignant_id);

    // Enregistrer le module dans la base de données
    if ($module->save()) {
        // Assigner le module à l'utilisateur enseignant
        $enseignant->modules()->attach($module);

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('chef')->with('success', 'Le module a été créé et attribué à l\'enseignant avec succès.');
    } else {
        // Gérer l'échec de l'enregistrement du module
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du module.');
    }

}
public function destroy(Property $property)
    {


        // Supprimer la propriété
        $property->delete();
$propertyjour_debut = $property->jour_debut;
         $propertyjour_fin = $property->jour_fin;
         $propertyheure_debut = $property->heure_debut;
         $propertyheure_fin = $property->heure_fin;
         $propertymodule_id = $property->module->nom;
         $propertyufr = $property->ufr->nom; // Suppose que le modèle UFR a une propriété nom
         $propertyfiliere = $property->filiere->nom; // Suppose que le modèle Filiere a une propriété nom
         $propertypromotion = $property->promotion->annee;
         $propertyenseignant = $property->enseignant;
         $propertysemestre = $property->semestre->intitule;
         $propertybatiment_id = $property->batiment->nom;
         $propertysalle_id = $property->salle->nom;
         $propertyuser_id = $property->user_id;
         $propertyannee_academique_debut = $property->annee_academique->annee_debut;
         $propertyannee_academique_fin = $property->annee_academique->annee_fin;

         // Envoi de la notification à l'enseignant via Telegram
         Telegram::sendMessage([
             "chat_id" => env('TELEGRAM_CHAT_ID', ''),
             "parse_mode" => 'HTML',
             "text" => "Bonjour Dr $propertyenseignant,

                A votre ATTENTION Votre programme du <b>$propertyjour_debut</b> au <b>$propertyjour_fin</b> a été suprrimée avec succès aux cours de

             - Année académique : <b>$propertyannee_academique_debut - $propertyannee_academique_fin</b>:

             - Heure de début : <b>$propertyheure_debut</b>

             - Heure de fin : <b>$propertyheure_fin</b>

             - Module : <b>$propertymodule_id</b>

             - UFR : <b>$propertyufr</b>

             - Filière : <b>$propertyfiliere</b>

             - Semestre : <b>$propertysemestre</b>

             - Bâtiment : <b>$propertybatiment_id</b>

             - Salle : <b>$propertysalle_id</b>

             - Promotion : <b>$propertypromotion</b>

             Vous pouvez creer un nouveau programme

             Cordialement, UNZ_PEDAGO"
         ]);
        // Rediriger avec un message de succès
        return redirect()->route('admin.property.index')->with('success', 'Le Programme a été supprimée avec succès !');
    }

public function modulo()
{
    $user = Auth::user();

    // Récupérer tous les utilisateurs
    $users = User::all();
    $annee_academiques = AnneeAcademique::all();
    // Passer les utilisateurs à la vue
    return view('private.chef.modul', compact('annee_academiques') ,['users' => $users]);
}

public function homemod()
{
    $user = Auth::user();
    $modules = auth()->user()->modules;
    // Récupérer tous les utilisateurs
    $users = User::all();
    $annee_academiques = AnneeAcademique::all();
    // Passer les utilisateurs à la vue
    return view('private.chef.homemod', compact('modules','user','annee_academiques'),['users' => $users]);
}

// RECUPERER L ID_CHAT dans le groupe
public function teleupdate()
{
    $updates = Telegram::getUpdates();
    $response = Telegram::getMe();
dd($updates);
}

public function getSemestresByFiliere(Filiere $filiere)
{
    $semestres = $filiere->semestres;

    return response()->json($semestres);
}


}

