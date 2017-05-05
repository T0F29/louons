<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOEvaluation;
use Locations\Model\Dao\DAOPhoto;
use Locations\Model\Dao\DAOSe_loue;
use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/DAOAnnonce.php');
include(dirname(__FILE__).'/../model/dao/DAOEvaluation.php');
include(dirname(__FILE__).'/../model/dao/DAOPhoto.php');
include(dirname(__FILE__).'/../model/dao/DAOSe_loue.php');

class Annonces extends Controller{

    public function lancer() {
        
        $vue = new View('VueAnnonces');
        $annonces = DAOAnnonce::recupererTous();
        $infos = array();
        foreach ($annonces as $annonce)
        {
            $tableau = array();
            $photoPrincipale = DAOPhoto::recupererPrincipaleDUneLocation($annonce->getLocation()->getId());
            $nbDEvaluations = DAOEvaluation::compterTousDUneLocation($annonce->getLocation()->getId());
            $moyenneNotes = DAOEvaluation::calculerMoyennedesNotesDUneLocation($annonce->getLocation()->getId());
            $tarifLePlusBas = DAOSe_loue::recupererTarifLePlusBasDUneLocation($annonce->getLocation()->getId());
            $tableau = array("annonce"=>$annonce, "photoPrincipale"=>$photoPrincipale, "nombreDEvaluation"=>$nbDEvaluations, "moyenneNotes"=>$moyenneNotes, "tarifLePlusBas"=>$tarifLePlusBas);
            array_push($infos, $tableau);
        }
        if (empty($infos)){
            $this->definirErreur('Il n\'y a pas d\'annonce');
        }
        $vue->rendre(array("erreur"=>$this->recupererErreur(), "infos"=>$infos));
        
    }

}
