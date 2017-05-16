<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOEvaluation;
use Locations\Model\Dao\DAOPhoto;
use Locations\Model\Dao\DAOSe_loue;
use Locations\View\View;


class MesAnnonces extends Controller{

    public function lancer() {
        
        $vue = new View('VueMesAnnonces');
        $annonces = DAOAnnonce::recupererTousDUnProprietaire($_SESSION['utilisateur_connecte']['id']);
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
        $vue->rendre(array("infos"=>$infos));
        
        
    }

}
