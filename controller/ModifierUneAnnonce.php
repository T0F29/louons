<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOEnvironnement;
use Locations\Model\Dao\DAOPays;
use Locations\Model\Dao\DAOPhoto;
use Locations\Model\Dao\DAOSubdivision1;
use Locations\Model\Dao\DAOSubdivision2;
use Locations\Model\Dao\DAOType;
use Locations\View\View;


class ModifierUneAnnonce extends Controller{

    public function lancer() {
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vue = new View('VueModifierUneAnnonce');
        $annonce = DAOAnnonce::recupererUnParSonId($id);
        $photos = DAOPhoto::recupererTousDUneLocation($annonce->getLocation()->getId());
        $listeTousEnvironnements = DAOEnvironnement::recupererTous();
        $listeTousTypes = DAOType::recupererTous();
        $listeTousPays = DAOPays::recupererTous();
        $listeToutesSubdivisions1 = DAOSubdivision1::recupererTous();
        $listeToutesSubdivisions2 = DAOSubdivision2::recupererTous();
        if (empty($annonce)){
            $this->definirErreur('Il n\'y a pas de résultat correspondant à ce numéro d\'annonce');
        }
        $vue->rendre(array("erreur"=>$this->recupererErreur(), "annonce"=>$annonce, "photos"=>$photos, "listeTousEnvironnements"=>$listeTousEnvironnements, "listeTousTypes"=>$listeTousTypes, "listeTousPays"=>$listeTousPays, "listeToutesSubdivisions1"=>$listeToutesSubdivisions1, "listeToutesSubdivisions2"=>$listeToutesSubdivisions2));
        
    }

}
