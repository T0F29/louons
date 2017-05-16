<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOMembre;
use Locations\View\View;


class TraiterConnexion extends Controller{  
    
    public function lancer() {
        
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        
        if ($this->verifierSiDonneesSaisiesSontCorrectes($pseudo, $mdp)) {
            
            $membre = DAOMembre::recupererUnParSonPseudo($pseudo);
            //$utilisateur_connecte = new Utilisateur_connecte($membre->getId(), $membre->getPseudo(), $membre->getMot_de_passe_hashe(), $membre->getPrenom(), $membre->getNom(), $membre->getAdresse(), $membre->getCode_postal(), $membre->getVille(), $membre->getPays(), $membre->getEmail(), $membre->getTelephone(), $membre->getStatut(), false);
            $utilisateur_connecte = array(
                'id'=>$membre->getId(),
                'pseudo'=>$membre->getPseudo(),
                'prenom'=>$membre->getPrenom(),
                'admin'=>false);
                $_SESSION['utilisateur_connecte'] = $utilisateur_connecte;

            if ($membre->getPseudo()=='admin'){
                $utilisateur_connecte['admin'] = true;
                $_SESSION['utilisateur_connecte'] = $utilisateur_connecte;
            }

            header("Location: index.php?action=EspaceMembre", true, 303);

        }
        
        if ($this->avoirErreur()){
            //réafficher le formulaire
            $view = new View('VueConnexion'); 
            $view->rendre(array("erreur"=>$this->recupererErreur(), "pseudo"=>$pseudo)); 
        }
    }
    
    private function verifierSiDonneesSaisiesSontCorrectes($pseudo, $mdp) {

        // Si les variables obligatoires n'existent pas ou sont nulles
        if (empty($pseudo) || empty($mdp)){
            $this->definirErreur('Le login et le mot de passe sont obligatoires');
            return false;
        }
        
        // Si le pseudo n'est pas utilisé
        if (!DAOMembre::verifierSiPseudoEstUtilise($pseudo)) {
            $this->definirErreur('Ce nom d\'utilisateur ou ce mot de passe est incorrect');
            return false;
        }
        
        $membre = DAOMembre::recupererUnParSonPseudo($pseudo);
        
        // Si le mot de passe est incorrect
        if (!password_verify($mdp, $membre->getMot_de_passe_hashe())) {
            $this->definirErreur('Ce nom d\'utilisateur ou ce mot de passe est incorrect');
            return false;
        }
        
        return true;
        
    }

}
