<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOMembre;
use Locations\Model\Dao\DAOPays;
use Locations\Model\Entities\Membre;
use Locations\View\View;


class TraiterInscription extends Controller{  
    
    public function lancer() {
        
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $mdp_confirmation = filter_input(INPUT_POST, 'mdp_confirmation', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
        $cp = filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING);
        $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
        $pays_id = filter_input(INPUT_POST, 'pays_id', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
        
        $pays = DAOPays::recupererUnParSonId($pays_id);
        
        if ($this->verifierSiDonneesSaisiesSontCorrectes($pseudo, $mdp, $mdp_confirmation, $prenom, $nom, $adresse, $cp, $ville, $pays_id, $email, $telephone)) {

            // Génération du code de confirmation
            $lettres_chiffres = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $lettres_chiffres_melanges = str_shuffle($lettres_chiffres);
            $code = substr($lettres_chiffres_melanges, 1, 10);
            
            // Si le mail a été envoyé on peut enregistrer le membre
            /*if (this->verifierSiEnvoiEmailDeValidationAFonctionne($email, $code))
            {*/
                // Hashage du mot de passe
                $mdp_hashe = password_hash($mdp, PASSWORD_DEFAULT);
                
                $membre = new Membre($pseudo, $mdp_hashe, $prenom, $nom, $adresse, $cp, $ville, $pays, $email, $telephone);
                DAOMembre::ajouterUn($membre);
                header("Location: index.php?action=Connexion",true,303);

            /*}else{
                $this->definirErreur('Pour une raison inconnue, l\'email de confirmation d\'inscription n\'a pu être envoyé');
            }*/
            
        }
        
        if ($this->avoirErreur()) {
            //réafficher le formulaire
            $vue = new View('VueInscription'); 
            $listeTousPays = DAOPays::recupererTous();
            $futur_membre = new Membre($pseudo, $prenom, $nom, $adresse, $cp, $ville, $pays, $email, $telephone);
            $vue->rendre(array("erreur"=>$this->recupererErreur(), "listeTousPays"=>$listeTousPays, "futur_membre"=>$futur_membre)); 
        }
        
    }

    private function verifierSiDonneesSaisiesSontCorrectes($pseudo, $mdp, $mdp_confirmation, $prenom, $nom, $adresse, $cp, $ville, $pays, $email, $telephone) {
        
        // Si les variables obligatoires n'existent pas ou sont nulles
        if (empty($pseudo) || empty($mdp) || empty($prenom) || empty($nom) || empty($adresse) || empty($cp) || empty($ville) || empty($pays) || empty($email) || empty($telephone)) {
            $this->definirErreur('Toutes les informations demandées doivent être saisies');
            return false;
        }

        // Si le pseudo contient moins de 4 caractères
        if (strlen($pseudo) < 4) {
            $this->definirErreur('Le nom d\'utilisateur doit compter au minimum 4 caractères');
            //var_dump($expression)
            return false;
        }
                
        // Si le pseudo est déjà utilisé
        if (DAOMembre::verifierSiPseudoEstUtilise($pseudo)) {
            $this->definirErreur('Ce pseudo est déjà pris par un autre utilisateur');
            return false;
        }
        
        // Si les 2 champs "mot de passe" sont différents
        if ($mdp != $mdp_confirmation) {
            $this->definirErreur('Les 2 mots de passes saisis sont différents');
            return false;
        }

        // Si le mot de passe contient moins de 6 caractères
        if (strlen($mdp) < 6) {
            $this->definirErreur('Le mot de passe doit compter au minimum 6 caractères');
            return false;
        }

        // Si l'adresse email est déjà utilisée
        if (DAOMembre::verifierSiEmailEstUtilise($email)) {
            $this->definirErreur('Il y a déjà un membre inscrit utilisant cette adresse email');
            return false;
        }
        
        return true;

    }

    private function verifierSiEnvoiEmailDeValidationAFonctionne($email, $code) {
        
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
        {
                $passage_ligne = "\r\n";
        }
        else
        {
                $passage_ligne = "\n";
        }
        //=====Déclaration des messages au format texte et au format HTML.
        $message_txt = sprintf('Bonjour %s.\n\nVous venez de vous inscrire sur le site LocaVacances.\nPour confirmer votre adresse email, veuillez cliquer sur le lien ci-dessous:\n%s/index.php?action=validerAdresseEmail&code=%s', $prenom, $_SERVER["HTTP_HOST"], $code);
        $message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
        //==========

        //=====Création de la boundary.
        $boundary = "-----=".md5(rand());
        $boundary_alt = "-----=".md5(rand());
        //==========

        //=====Définition du sujet.
        $sujet = "Validation de votre adresse email";
        //=========

        //=====Création du header de l'e-mail.
        $header = "From: \"WeaponsB\"<weaponsb@mail.fr>".$passage_ligne;
        $header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
        //==========

        //=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;
        $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
        $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
        //=====Ajout du message au format texte.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;
        //==========

        $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

        //=====Ajout du message au format HTML.
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
        //==========

        //=====On ferme la boundary alternative.
        $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
        //==========



        if (mail($email, $sujet, $message, $header))
            return true;
        else
            return false;

        
    }
    
}
