<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExcellController;
use App\Http\Controllers\AfficheController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Ressources\FiliereController;
use App\Http\Controllers\Ressources\UesController;
use App\Http\Controllers\Ressources\UfrController;
use App\Http\Controllers\Ressources\SalleController;
use App\Http\Controllers\Ressources\SemestreController;


class VoiceCommandController extends Controller
{


    public function commande(){
        return view('vocales.commande');
    }

    public function remplir(){
        return view('vocales.remplir');
    }
    
    public function executeCommand(Request $request)
    {
        $command = $request->input('command');

        Log::info('Commande reçue : ' . $command);

        $nomSalle = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
        $capaciteSalle = !empty($_POST['capacite']) ? $_POST['capacite'] : NULL;
        $batimentId = !empty($_POST['batiment_id']) ? $_POST['batiment_id'] : NULL;
        $nomBatiment = !empty($_POST['nom_batiment']) ? $_POST['nom_batiment'] : NULL;
        //dd($command); // Afficher la commande côté serveur
        try {
            switch ($command) {
                case 'inscription':
                    return (new RegisterController())->showRegister();
                    break;
                case 'connexion':
                    return view('auth.connexion');
                    break;
                //Routes pour les salles
                
                case 'salle':
                    return (new SalleController())->index();
                    break;

                case 'créer une salle':
                    $resultatReconnaissanceNomSalle = $request->input('resultatReconnaissanceNomSalle');
                    $resultatReconnaissanceCapaciteSalle = $request->input('resultatReconnaissanceCapaciteSalle');
                    $resultatReconnaissanceBatimentId = $request->input('resultatReconnaissanceBatimentId');

                    // Utiliser les valeurs extraites pour remplir les variables
                    $nomSalle = $resultatReconnaissanceNomSalle;
                    $capaciteSalle = $resultatReconnaissanceCapaciteSalle;
                    $batimentId = $resultatReconnaissanceBatimentId;   
                    // Remplir le formulaire avec les données extraites
                    return view('ressources.Salle.creer', compact('nomSalle', 'capaciteSalle', 'batimentId'));
                    break;
                
                case 'salle.store':
                    return (new SalleController())->store($request);
                    break;
                case 'modifier une salle':
                    $salleId = $request->route('salle');
                    return (new SalleController())->edit($salleId);
                    break;
                case 'modifier la salle':
                        $salleId = $request->route('salle');
                    return (new SalleController())->update($request, $salleId);
                    break;
                case 'supprimer une salle':
                    $salleId = $request->route('salle');
                    return (new SalleController())->destroy($salleId);
                    break;

                    //Routes pour les Filière
                case 'filière':
                    return (new FiliereController())->index();
                    break;

                case 'créer une filière':
                    return (new FiliereController())->create();
                    break;
                case 'créer':
                    return (new FiliereController())->store($request);
                    break;
                case 'modifier une filière':
                    $filiereId = $request->route('filiere');
                    return (new FiliereController())->edit($filiereId);
                    break;
                case 'modifier la filière':
                    $filiereId = $request->route('filiere');
                    return (new FiliereController())->update($request, $filiereId);
                    break;
                case 'Supprimer une filière':
                    $filiereId = $request->route('filiere');
                    return (new FiliereController())->destroy($filiereId);
                    break;
                // Routes pour les UES
                case 'ues':
                    return (new UesController())->index();
                    break;
                case 'créer une ues':
                    return (new UesController())->create();
                    break;
                case 'créer':
                    return (new UesController())->store($request);
                    break;
                case 'ues.show':
                    $uesId = $request->route('ues');
                    return (new UesController())->show($uesId);
                    break;
                case 'editer':
                    $uesId = $request->route('ues');
                    return (new UesController())->edit($uesId);
                    break;
                    case 'mettre a jour':
                    $uesId = $request->route('ues');
                    return (new UesController())->update($request, $uesId);
                    break;
                case 'supprimer':
                    $uesId = $request->route('ues');
                     return (new UesController())->destroy($uesId);
                    break;
                // Routes pour les UFRs
                case 'ufr':
                    
                    return (new UfrController())->index();
                    break;
                case 'créer une ufr':
                    return (new UfrController())->create();
                    break;
                case "créer l'ufr":
                    return (new UfrController())->store($request);
                    break;
                case 'ufrs.show':
                    $ufrId = $request->route('ufr');
                    return (new UfrController())->show($ufrId);
                    break;
                case "Editer l'ufr":
                    $ufrId = $request->route('ufr');
                    return (new UfrController())->edit($ufrId);
                    break;
                case "Mettre à jour l'ufr":
                    $ufrId = $request->route('ufr');
                    return (new UfrController())->update($request, $ufrId);
                    break;
                case 'Supprimer ufr':
                    $ufrId = $request->route('ufr');
                    return (new UfrController())->destroy($ufrId);
                    break;

                // Routes pour les semestres
                case 'liste des semestres' || 'semestre':
                    return (new SemestreController())->index();
                    break;
                case 'créer un semestre':
                    return (new SemestreController())->create();
                    break;
                case 'créer':
                    return (new SemestreController())->store($request);
                    break;
                case 'semestres.show':
                    $semestreId = $request->route('semestre');
                    return (new SemestreController())->show($semestreId);
                    break;
                case 'editer un semestre':
                    $semestreId = $request->route('semestre');
                    return (new SemestreController())->edit($semestreId);
                    break;
                case 'Mettre à jour le semestre':
                    $semestreId = $request->route('semestre');
                    return (new SemestreController())->update($request, $semestreId);
                    break;
                case 'Supprimer':
                    $semestreId = $request->route('semestre');
                    return (new SemestreController())->destroy($semestreId);
                    break;
            
                case 'valider':
                    $propertyId = $request->route('id');
                    return (new PropertyController())->statut($propertyId);
                    break;
                case 'module':
                    return (new PropertyController())->module($request);
                    break;
                case 'modulo':
                    return (new PropertyController())->modulo();
                    break;
                case 'homemod':
                    return (new PropertyController())->homemod();
                    break;


                // Routes pour l'importation de l'Excel
                case 'import.excel':
                    return (new ExcellController())->importExcel($request);
                    break;
        
                // Routes pour afficher la liste des utilisateurs
                case 'afficheuser':
                    return (new AfficheController())->affiche();
                    break;

                // Route pour supprimer un utilisateur
                case 'supprimer':
                    $userId = $request->route('user');
                    return (new AfficheController())->destro($userId);
                    break;

                // Route pour créer un nouvel utilisateur
                case 'creer':
                    return (new AfficheController())->create();
                    break;

                // Route pour stocker un nouvel utilisateur
                case 'creat':
                    return (new AfficheController())->store($request);
                    break;

               // Route pour créer un nouvel étudiant
               case 'creer_etudiant':
                   return (new AfficheController())->createStudent();
                   break;

               // Route pour stocker un nouvel enseignant
               case 'storeEnseignant':
                   return (new AfficheController())->storeEnseignant($request);
                   break;

                // Route pour modifier un utilisateur
                case 'modifier':
                    $userId = $request->route('user');
                    return (new AfficheController())->update($request, $userId);
                    break;

                // Route pour afficher le formulaire de modification d'un utilisateur
                case 'editer':
                    $userId = $request->route('user');
                    return (new AfficheController())->edit($userId);
                    break;

                    // Route pour mettre à jour un module
       
                    
                default:
                    // Commande non reconnue
                    return response()->json(['error' => 'Commande non reconnue'], 400);
            }
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'exécution de la commande : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de l\'exécution de la commande'], 500);
        }
    }
}
