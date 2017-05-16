<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;



class TraiterSupprimerUneAnnonce extends Controller{  
    
    public function lancer() {
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        DAOAnnonce::supprimerUn($id, $_SESSION['utilisateur_connecte']['id']);
        header("Location: index.php?action=MesAnnonces",true,303);
    }
    
}
