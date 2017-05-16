<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Membre;
use Locations\Model\Entities\Pays;
use Locations\Model\Entities\Statut_membre;


class DAOMembre {
    
    /**
     * Vérifier si un pseudo est déjà utilisé
     * @param type $pseudo Pseudo à tester
     * @return boolean
     */
    static function verifierSiPseudoEstUtilise($pseudo){
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare(
                'SELECT COUNT(*) '
                . 'FROM membre '
                . 'WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo);
        $req->execute();
	$res = $req->fetchColumn();
        return ($res>0);
        
    }
    
    /**
     * Vérifier si un email est déjà utilisé
     * @param type $email Email à tester
     * @return boolean
     */
    static function verifierSiEmailEstUtilise($email){
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare(
                'SELECT COUNT(*) '
                . 'FROM membre '
                . 'WHERE email = :email');
        $req->bindValue(':email', $email);
        $req->execute();
	$res = $req->fetchColumn();
        return ($res>0);
        
    }

    /**
     * Ajouter un membre à la base de données
     * @param type $membre Membre à ajouter
     * @return int $pdo->lastInsertId()
     */
    public static function ajouterUn($membre) {
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare(
                'INSERT INTO membre (pseudo, mot_de_passe_hashe, prenom, nom, adresse, code_postal, ville, pays_id, email, telephone, statut_id)
                VALUES (:pseudo, :mdp, :prenom, :nom, :adresse, :cp, :ville, :pays, :email, :telephone, 1)');
        $req->bindValue(':pseudo', $membre->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $membre->getMot_de_passe_hashe(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $membre->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':nom', $membre->getNom(), PDO::PARAM_STR);
        $req->bindValue(':adresse', $membre->getAdresse(), PDO::PARAM_STR);
        $req->bindValue(':cp', $membre->getCode_postal(), PDO::PARAM_STR);
        $req->bindValue(':ville', $membre->getVille(), PDO::PARAM_STR);
        $req->bindValue(':pays', $membre->getPays()->getId(), PDO::PARAM_STR);
        $req->bindValue(':email', $membre->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':telephone', $membre->getTelephone(), PDO::PARAM_STR);

        $res = $req->execute();
        if ($res) {
            return $pdo->lastInsertId();
        } else {
            return -1;
        }
        
    }

    /**
     * Récupérer un membre par son identifiant
     * @param type $id Identifiant du membre
     * @return Membre $membre
     */
    public static function recupererUnParSonId($id) {

	$pdo = BDD::recupererConnexion();
	
	$req = $pdo->prepare(
                'SELECT m.id, m.pseudo, m.mot_de_passe_hashe, m.prenom, m.nom, m.adresse, m.code_postal, m.ville, m.pays_id, p.determinant AS pays_determinant, p.nom1 AS pays_nom1, p.nom2 AS pays_nom2, p.nom3 AS pays_nom3, m.email, m.telephone, m.statut_id, s.nom AS statut_nom '
                . 'FROM membre AS m '
                . 'INNER JOIN pays AS p ON m.pays_id=p.id '
                . 'INNER JOIN statut_membre AS s ON m.statut_id=s.id '
                . 'WHERE m.id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        $pays = new Pays();
        $pays->setId($resultat->pays_id);
        $pays->setDeterminant($resultat->pays_determinant);
        $pays->setNom1($resultat->pays_nom1);
        $pays->setNom2($resultat->pays_nom2);
        $pays->setNom3($resultat->pays_nom3);
        
        $statut = new Statut_membre();
        $statut->setId($resultat->statut_id);
        $statut->setNom($resultat->statut_nom);
        
        $membre = new Membre();
        $membre->setId($resultat->id);
        $membre->setPseudo($resultat->pseudo);
        $membre->setMot_de_passe_hashe($resultat->mot_de_passe_hashe);
        $membre->setPrenom($resultat->prenom);
        $membre->setNom($resultat->nom);
        $membre->setAdresse($resultat->adresse);
        $membre->setCode_postal($resultat->code_postal);
        $membre->setVille($resultat->ville);
        $membre->setPays($pays);
        $membre->setEmail($resultat->email);
        $membre->setTelephone($resultat->telephone);
        $membre->setStatut($statut);

	return $membre;
        
    }
    
    /**
     * Récupérer un membre par son pseudo
     * @param type $pseudo Pseudo du membre
     * @return Membre $membre
     */
    static function recupererUnParSonPseudo($pseudo){

	$pdo = BDD::recupererConnexion();
	
	$req = $pdo->prepare(
                'SELECT m.id, m.pseudo, m.mot_de_passe_hashe, m.prenom, m.nom, m.adresse, m.code_postal, m.ville, m.pays_id, p.determinant AS pays_determinant, p.nom1 AS pays_nom1, p.nom2 AS pays_nom2, p.nom3 AS pays_nom3, m.email, m.telephone, m.statut_id, s.nom AS statut_nom '
                . 'FROM membre AS m '
                . 'INNER JOIN pays AS p ON m.pays_id=p.id '
                . 'INNER JOIN statut_membre AS s ON m.statut_id=s.id '
                . 'WHERE m.pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
	
        $pays = new Pays();
        $pays->setId($resultat->pays_id);
        $pays->setDeterminant($resultat->pays_determinant);
        $pays->setNom1($resultat->pays_nom1);
        $pays->setNom2($resultat->pays_nom2);
        $pays->setNom3($resultat->pays_nom3);
        
        $statut = new Statut_membre();
        $statut->setId($resultat->statut_id);
        $statut->setNom($resultat->statut_nom);
        
        $membre = new Membre();
        $membre->setId($resultat->id);
        $membre->setPseudo($resultat->pseudo);
        $membre->setMot_de_passe_hashe($resultat->mot_de_passe_hashe);
        $membre->setPrenom($resultat->prenom);
        $membre->setNom($resultat->nom);
        $membre->setAdresse($resultat->adresse);
        $membre->setCode_postal($resultat->code_postal);
        $membre->setVille($resultat->ville);
        $membre->setPays($pays);
        $membre->setEmail($resultat->email);
        $membre->setTelephone($resultat->telephone);
        $membre->setStatut($statut);

	return $membre;
        
    }

    public static function recupererTous() {
        
    }

    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
