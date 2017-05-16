<?php

namespace Locations;

require('vendor/autoload.php');
require('config.inc.php');

use Locations\View\View;

session_start();

//controleur par défaut
$ctrl = 'Accueil';

//Récupération du nom du contrôleur dans variable $action. Peut être envoyée par GET ou POST
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

//direct_rendering=true means don't output main template, only conntent from controller
$direct_rendering = filter_input(INPUT_GET, 'direct_rendering', FILTER_VALIDATE_BOOLEAN);
if (!$direct_rendering) {
    $direct_rendering = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

if ($action) {
    if (file_exists('controller/'.$action.'.php')) {
        $ctrl = $action;
    } else {
        http_response_code(404);
        return;
    }
}

//Si on tente d'accéder aux pages protégées sans être logué, on redirige vers Connexion
if (!isset($_SESSION['utilisateur_connecte']) && (!in_array($ctrl, DMZ))) {
    //redirect to login
    header("Location: index.php?action=Connexion");
}



//Charge le contrôleur
include('controller/'.$ctrl.'.php');


$ctrlClassName = "Locations\\Controller\\".$ctrl;
$controller = new $ctrlClassName();

//injecter infos session du membre 
/*if (isset($_SESSION['id_membre'])) {
    $controller->setId_membre($_SESSION['id_membre']);
    $controller->setPseudo_membre($_SESSION['pseudo_membre']);
    $controller->setIsAdmin($_SESSION['isadmin']);
}*/

//charge la sortie des controleurs en mémoire
ob_start();

$controller->lancer();

$contenu = ob_get_clean();

//

if ($direct_rendering){ //don't render with template
    //header('Content-type: application/json');
    echo $contenu;
}else{
    $donnees = array(
        "erreur"=>$controller->recupererErreur(),
	"contenu"=>$contenu, 
        "id_membre" => $controller->getId_membre(),
        "pseudo_membre" => $controller->getPseudo_membre(),
        "isadmin" => $controller->isAdmin()
        );
    //var_dump($donnees);
    //charger la vue
    $tpl = new View('templatePrincipal');

    $tpl->rendre($donnees);
}

