<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOEnvironnement;
use Locations\Model\Dao\DAOPays;
use Locations\Model\Dao\DAOSubdivision1;
use Locations\Model\Dao\DAOSubdivision2;
use Locations\Model\Dao\DAOType;
use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/DAOEnvironnement.php');
include(dirname(__FILE__).'/../model/dao/DAOPays.php');
include(dirname(__FILE__).'/../model/dao/DAOSubdivision1.php');
include(dirname(__FILE__).'/../model/dao/DAOSubdivision2.php');
include(dirname(__FILE__).'/../model/dao/DAOType.php');

class AjouterUneAnnonce extends Controller{

    public function lancer() {
        
        $vue = new View('VueAjouterUneAnnonce');
        $listeTousEnvironnements = DAOEnvironnement::recupererTous();
        $listeTousTypes = DAOType::recupererTous();
        $listeTousPays = DAOPays::recupererTous();
        $listeToutesSubdivisions1 = DAOSubdivision1::recupererTous();
        $listeToutesSubdivisions2 = DAOSubdivision2::recupererTous();
        $vue->rendre(array("erreur"=>$this->recupererErreur(), "listeTousEnvironnements"=>$listeTousEnvironnements, "listeTousTypes"=>$listeTousTypes, "listeTousPays"=>$listeTousPays, "listeToutesSubdivisions1"=>$listeToutesSubdivisions1, "listeToutesSubdivisions2"=>$listeToutesSubdivisions2));
        
    }

}
