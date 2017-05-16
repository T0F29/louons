<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOPhoto;
use Locations\View\View;


class MonAnnonce extends Controller{

    public function lancer() {
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vue = new View('VueMonAnnonce');
        $annonce = DAOAnnonce::recupererUnParSonId($id);
        $photos = DAOPhoto::recupererTousDUneLocation($annonce->getLocation()->getId());
        if (empty($annonce)){
            $this->definirErreur('Il n\'y a pas de résultat correspondant à ce numéro d\'annonce');
        }
        $vue->rendre(array("erreur"=>$this->recupererErreur(), "annonce"=>$annonce, "photos"=>$photos));
        
    }

}
