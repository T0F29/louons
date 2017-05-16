<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOPhoto;
use Locations\Model\Dao\DAOEvaluation;
use Locations\Model\Dao\DAOSe_loue;
use Locations\View\View;


class SupprimerUneAnnonce extends Controller{

    public function lancer() {
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vue = new View('VueSupprimerUneAnnonce');
        $annonce = DAOAnnonce::recupererUnParSonId($id);
        $photoPrincipale = DAOPhoto::recupererPrincipaleDUneLocation($annonce->getLocation()->getId());
        $nbDEvaluations = DAOEvaluation::compterTousDUneLocation($annonce->getLocation()->getId());
        $moyenneNotes = DAOEvaluation::calculerMoyennedesNotesDUneLocation($annonce->getLocation()->getId());
        $tarifLePlusBas = DAOSe_loue::recupererTarifLePlusBasDUneLocation($annonce->getLocation()->getId());
        $vue->rendre(array("erreur"=>$this->recupererErreur(), "annonce"=>$annonce, "photoPrincipale"=>$photoPrincipale, "nombreDEvaluation"=>$nbDEvaluations, "moyenneNotes"=>$moyenneNotes, "tarifLePlusBas"=>$tarifLePlusBas));
        
    }

}
