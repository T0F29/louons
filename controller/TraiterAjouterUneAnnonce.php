<?php

namespace Locations\Controller;

use DateTime;
use Locations\Model\Dao\DAOAnnonce;
use Locations\Model\Dao\DAOEnvironnement;
use Locations\Model\Dao\DAOMembre;
use Locations\Model\Dao\DAOPays;
use Locations\Model\Dao\DAOSubdivision1;
use Locations\Model\Dao\DAOSubdivision2;
use Locations\Model\Dao\DAOType;
use Locations\Model\Entities\Annonce;
use Locations\Model\Entities\Location;
use Locations\View\View;


class TraiterAjouterUneAnnonce extends Controller{  
    
    public function lancer() {
        
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
        $environnement_id = filter_input(INPUT_POST, 'environnement_id', FILTER_SANITIZE_NUMBER_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_NUMBER_INT);
        $cp = filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING);
        $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
        $pays_id = filter_input(INPUT_POST, 'pays_id', FILTER_SANITIZE_STRING);
        $subdivision1_id = filter_input(INPUT_POST, 'subdivision1_id', FILTER_SANITIZE_STRING);
        $subdivision2_id = filter_input(INPUT_POST, 'subdivision2_id', FILTER_SANITIZE_STRING);
        $surface_habitable = filter_input(INPUT_POST, 'surface_habitable', FILTER_SANITIZE_NUMBER_INT);
        $surface_terrain = filter_input(INPUT_POST, 'surface_terrain', FILTER_SANITIZE_NUMBER_INT);
        $nb_max_personnes = filter_input(INPUT_POST, 'nb_max_personnes', FILTER_SANITIZE_NUMBER_INT);
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_STRING);
        
        $environnement = DAOEnvironnement::recupererUnParSonId($environnement_id);
        $type = DAOType::recupererUnParSonId($type_id);
        $pays = DAOPays::recupererUnParSonId($pays_id);
        $subdivision1 = DAOSubdivision1::recupererUnParSonId($subdivision1_id);
        $subdivision2 = DAOSubdivision2::recupererUnParSonId($subdivision2_id);
        $membre = DAOMembre::recupererUnParSonId($_SESSION['utilisateur_connecte']['id']);

        $location = new Location();
        $location->setEnvironnement($environnement);
        $location->setType($type);
        $location->setCode_postal($cp);
        $location->setVille($ville);
        $location->setSubdivision2($subdivision2);
        $location->setSubdivision1($subdivision1);
        $location->setPays($pays);
        $location->setSurface_habitable($surface_habitable);
        $location->setSurface_terrain($surface_terrain);
        $location->setNb_max_personnes($nb_max_personnes);
        $location->setProprietaire($membre);

        $dateActuelle = new DateTime();
        $dateAnnonce = $dateActuelle->format('Y-m-d H:i:s');

        $annonce = new Annonce();
        $annonce->setTitre($titre);
        $annonce->setContenu($contenu);
        $annonce->setDate_annonce($dateAnnonce);
        $annonce->setLocation($location);
        
        if ($this->verifierSiDonneesSaisiesSontCorrectes($titre, $environnement_id, $type_id, $cp, $ville, $pays_id, $subdivision1_id, $subdivision2_id, $surface_habitable, $surface_terrain, $nb_max_personnes, $contenu)) {

            DAOAnnonce::ajouterUn($annonce);
            header("Location: index.php?action=MesAnnonces",true,303);
        }
        
        if ($this->avoirErreur()) {
            //réafficher le formulaire
            $vue = new View('VueAjouterUneAnnonce');
            $listeTousEnvironnements = DAOEnvironnement::recupererTous();
            $listeTousTypes = DAOType::recupererTous();
            $listeTousPays = DAOPays::recupererTous();
            $listeToutesSubdivisions1 = DAOSubdivision1::recupererTous();
            $listeToutesSubdivisions2 = DAOSubdivision2::recupererTous();

            $vue->rendre(array("erreur"=>$this->recupererErreur(), "listeTousEnvironnements"=>$listeTousEnvironnements, "listeTousTypes"=>$listeTousTypes, "listeTousPays"=>$listeTousPays, "listeToutesSubdivisions1"=>$listeToutesSubdivisions1, "listeToutesSubdivisions2"=>$listeToutesSubdivisions2, "annonce"=>$annonce));
        }
        
    }

    private function verifierSiDonneesSaisiesSontCorrectes($titre, $environnement_id, $type_id, $cp, $ville, $pays_id, $surface_habitable, $surface_terrain, $nb_max_personnes, $contenu) {
        
        // Si les variables obligatoires n'existent pas ou sont nulles
        if (empty($titre) || empty($environnement_id) || empty($type_id) || empty($cp) || empty($ville) || empty($pays_id) || empty($surface_habitable) || empty($surface_terrain) || empty($nb_max_personnes) || empty($contenu)) {
            $this->definirErreur('Toutes les informations demandées doivent être saisies');
            return false;
        }
        
        return true;

    }


    
}
