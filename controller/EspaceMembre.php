<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\View\View;


class EspaceMembre extends Controller {
    
    public function lancer(){
        
        $vue = new View('VueEspaceMembre');
        $nbAnnonces = DAOAnnonce::compterTousDUnProprietaire($_SESSION['utilisateur_connecte']['id']);
        $vue->rendre(array("nbAnnonces"=>$nbAnnonces));
        
    }

}
