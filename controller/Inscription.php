<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOPays;
use Locations\View\View;


class Inscription extends Controller{  
    
    public function lancer() {
        if (isset($_SESSION['user_id'])){
            header("Location: index.php?action=Catalogue", true, 303);
        }
        else
        {
            $vue = new View('VueInscription');
            $listeTousPays = DAOPays::recupererTous();
            $vue->rendre(array("erreur"=>$this->recupererErreur(), "listeTousPays"=>$listeTousPays));
        }
        
    }

}
