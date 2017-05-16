<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use \Locations\Model\Entities\Environnement;
use \Locations\Model\Entities\Evaluation;
use \Locations\Model\Entities\Location;
use \Locations\Model\Entities\Membre;
use \Locations\Model\Entities\Pays;
use \Locations\Model\Entities\Statut_membre;
use Locations\Model\Entities\Subdivision1;
use Locations\Model\Entities\Subdivision2;
use \Locations\Model\Entities\Type;


class DAOEvaluation {
    
    /**
     * Récupérer toutes les évaluations
     * @return array $listeToutesEvaluations
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                "SELECT e.id, e.note, e.texte, e.date_evaluation, e.auteur_id, m1.pseudo AS auteur_pseudo, m1.mot_de_passe AS auteur_mot_de_passe, m1.prenom AS auteur_prenom, m1.nom AS auteur_nom, m1.adresse AS auteur_adresse, m1.code_postal AS auteur_code_postal, m1.ville AS auteur_ville, m1.pays_id AS auteur_pays_id, p1.determinant AS auteur_pays_determinant, p1.nom1 AS auteur_pays_nom1, p1.nom2 AS auteur_pays_nom2, p1.nom3 AS auteur_pays_nom3, m1.email AS auteur_email, m1.telephone AS auteur_telephone, m1.statut_id AS auteur_statut_id, s1.nom AS auteur_statut_nom, e.location_id, l.environnement_id AS location_environnement_id, env.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.departement_id AS location_departement_id, d.nom AS location_departement_nom, d.region_id AS location_departement_region_id, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m2.pseudo AS location_proprietaire_pseudo, m2.mot_de_passe AS location_proprietaire_mot_de_passe, m2.prenom AS location_proprietaire_prenom, m2.nom AS location_proprietaire_nom, m2.adresse AS location_proprietaire_adresse, m2.code_postal AS location_proprietaire_code_postal, m2.ville AS location_proprietaire_ville, m2.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m2.email AS location_proprietaire_email, m2.telephone AS location_proprietaire_telephone, m2.statut_id AS location_proprietaire_statut_id, s2.nom AS location_proprietaire_statut_nom "
                . "FROM evaluation AS e "
                . "INNER JOIN membre AS m1 ON e.auteur_id = m1.id "
                . "INNER JOIN pays AS p1 ON m1.pays_id = p1.id "
                . "INNER JOIN statut_membre AS s1 ON m1.statut_id = s1.id "
                . "INNER JOIN location AS l ON e.location_id = l.id "
                . "INNER JOIN environnement AS env ON l.environnement_id = env.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN departement AS d ON l.departement_id = d.id "
                . "INNER JOIN membre AS m2 ON l.proprietaire_id = m2.id "
                . "INNER JOIN pays AS p2 ON m2.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s2 ON m2.statut_id = s2.id");
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesEvaluations = array();
        foreach ($resultats as $donnee)
        {
            $environnement_location = new Environnement($donnee->location_environnement_id, $donnee->location_environnement_nom);
            $type_location = new Type($donnee->location_type_id, $donnee->location_type_nom);
            $departement_location = new Departement($donnee->location_departement_id, $donnee->location_departement_nom, $donnee->location_departement_region_id);
            $pays_proprietaire = new Pays($donnee->location_proprietaire_pays_id, $donnee->location_proprietaire_pays_determinant, $donnee->location_proprietaire_pays_nom1, $donnee->location_proprietaire_pays_nom2, $donnee->location_proprietaire_pays_nom3);
            $statut_proprietaire = new Statut_membre($donnee->location_proprietaire_statut_id, $donnee->location_proprietaire_statut_nom);
            $proprietaire = new Membre($donnee->location_proprietaire_id, $donnee->location_proprietaire_pseudo, $donnee->location_proprietaire_mot_de_passe, $donnee->location_proprietaire_prenom, $donnee->location_proprietaire_nom, $donnee->location_proprietaire_adresse, $donnee->location_proprietaire_code_postal, $donnee->location_proprietaire_ville, $pays_proprietaire, $donnee->location_proprietaire_email, $donnee->location_proprietaire_telephone, $statut_proprietaire);
            $location = new Location($donnee->location_id, $environnement_location, $type_location, $donnee->location_code_postal, $donnee->location_ville, $departement_location, $donnee->location_surface_habitable, $donnee->location_surface_terrain, $donnee->location_nb_max_personnes, $proprietaire);
            $pays_auteur = new Pays($donnee->auteur_pays_id, $donnee->auteur_pays_determinant, $donnee->auteur_pays_nom1, $donnee->auteur_pays_nom2, $donnee->auteur_pays_nom3);
            $statut_auteur = new Statut_membre($donnee->auteur_statut_id, $donnee->auteur_statut_nom);
            $auteur = new Membre($donnee->auteur_id, $donnee->auteur_pseudo, $donnee->auteur_mot_de_passe, $donnee->auteur_prenom, $donnee->auteur_nom, $donnee->auteur_adresse, $donnee->auteur_code_postal, $donnee->auteur_ville, $pays_auteur, $donnee->auteur_email, $donnee->auteur_telephone, $statut_auteur);
            $evaluation = new Evaluation($donnee->id, $donnee->note, $donnee->texte, $donnee->date_evaluation, $auteur, $location);
            array_push($listeToutesEvaluations, $evaluation);
        }
		   
	return $listeToutesEvaluations;
        
    }
  
    /**
     * Récupérer toutes les évaluations d'une location
     * @param int $id Identifiant de la location
     * @return array $listeToutesEvaluations
     */
    public static function recupererTousDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT e.id, e.note, e.texte, e.date_evaluation, e.auteur_id, m1.pseudo AS auteur_pseudo, m1.mot_de_passe AS auteur_mot_de_passe, m1.prenom AS auteur_prenom, m1.nom AS auteur_nom, m1.adresse AS auteur_adresse, m1.code_postal AS auteur_code_postal, m1.ville AS auteur_ville, m1.pays_id AS auteur_pays_id, p1.determinant AS auteur_pays_determinant, p1.nom1 AS auteur_pays_nom1, p1.nom2 AS auteur_pays_nom2, p1.nom3 AS auteur_pays_nom3, m1.email AS auteur_email, m1.telephone AS auteur_telephone, m1.statut_id AS auteur_statut_id, s1.nom AS auteur_statut_nom, e.location_id, l.environnement_id AS location_environnement_id, env.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.departement_id AS location_departement_id, d.nom AS location_departement_nom, d.region_id AS location_departement_region_id, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m2.pseudo AS location_proprietaire_pseudo, m2.mot_de_passe AS location_proprietaire_mot_de_passe, m2.prenom AS location_proprietaire_prenom, m2.nom AS location_proprietaire_nom, m2.adresse AS location_proprietaire_adresse, m2.code_postal AS location_proprietaire_code_postal, m2.ville AS location_proprietaire_ville, m2.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m2.email AS location_proprietaire_email, m2.telephone AS location_proprietaire_telephone, m2.statut_id AS location_proprietaire_statut_id, s2.nom AS location_proprietaire_statut_nom "
                . "FROM evaluation AS e "
                . "INNER JOIN membre AS m1 ON e.auteur_id = m1.id "
                . "INNER JOIN pays AS p1 ON m1.pays_id = p1.id "
                . "INNER JOIN statut_membre AS s1 ON m1.statut_id = s1.id "
                . "INNER JOIN location AS l ON e.location_id = l.id "
                . "INNER JOIN environnement AS env ON l.environnement_id = env.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN departement AS d ON l.departement_id = d.id "
                . "INNER JOIN membre AS m2 ON l.proprietaire_id = m2.id "
                . "INNER JOIN pays AS p2 ON m2.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s2 ON m2.statut_id = s2.id"
                . "WHERE l.id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesEvaluations = array();
        foreach ($resultats as $donnee)
        {
            $environnement_location = new Environnement($donnee->location_environnement_id, $donnee->location_environnement_nom);
            $type_location = new Type($donnee->location_type_id, $donnee->location_type_nom);
            $departement_location = new Departement($donnee->location_departement_id, $donnee->location_departement_nom, $donnee->location_departement_region_id);
            $pays_proprietaire = new Pays($donnee->location_proprietaire_pays_id, $donnee->location_proprietaire_pays_determinant, $donnee->location_proprietaire_pays_nom1, $donnee->location_proprietaire_pays_nom2, $donnee->location_proprietaire_pays_nom3);
            $statut_proprietaire = new Statut_membre($donnee->location_proprietaire_statut_id, $donnee->location_proprietaire_statut_nom);
            $proprietaire = new Membre($donnee->location_proprietaire_id, $donnee->location_proprietaire_pseudo, $donnee->location_proprietaire_mot_de_passe, $donnee->location_proprietaire_prenom, $donnee->location_proprietaire_nom, $donnee->location_proprietaire_adresse, $donnee->location_proprietaire_code_postal, $donnee->location_proprietaire_ville, $pays_proprietaire, $donnee->location_proprietaire_email, $donnee->location_proprietaire_telephone, $statut_proprietaire);
            $location = new Location($donnee->location_id, $environnement_location, $type_location, $donnee->location_code_postal, $donnee->location_ville, $departement_location, $donnee->location_surface_habitable, $donnee->location_surface_terrain, $donnee->location_nb_max_personnes, $proprietaire);
            $pays_auteur = new Pays($donnee->auteur_pays_id, $donnee->auteur_pays_determinant, $donnee->auteur_pays_nom1, $donnee->auteur_pays_nom2, $donnee->auteur_pays_nom3);
            $statut_auteur = new Statut_membre($donnee->auteur_statut_id, $donnee->auteur_statut_nom);
            $auteur = new Membre($donnee->auteur_id, $donnee->auteur_pseudo, $donnee->auteur_mot_de_passe, $donnee->auteur_prenom, $donnee->auteur_nom, $donnee->auteur_adresse, $donnee->auteur_code_postal, $donnee->auteur_ville, $pays_auteur, $donnee->auteur_email, $donnee->auteur_telephone, $statut_auteur);
            $evaluation = new Evaluation($donnee->id, $donnee->note, $donnee->texte, $donnee->date_evaluation, $auteur, $location);
            array_push($listeToutesEvaluations, $evaluation);
        }
		   
	return $listeToutesEvaluations;
        
    }
    
    /**
     * Récupérer une évaluation par son identifiant
     * @param int $id Identifiant de l'évaluation
     * @return Evaluation $evaluation
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT e.id, e.note, e.texte, e.date_evaluation, e.auteur_id, m1.pseudo AS auteur_pseudo, m1.mot_de_passe AS auteur_mot_de_passe, m1.prenom AS auteur_prenom, m1.nom AS auteur_nom, m1.adresse AS auteur_adresse, m1.code_postal AS auteur_code_postal, m1.ville AS auteur_ville, m1.pays_id AS auteur_pays_id, p1.determinant AS auteur_pays_determinant, p1.nom1 AS auteur_pays_nom1, p1.nom2 AS auteur_pays_nom2, p1.nom3 AS auteur_pays_nom3, m1.email AS auteur_email, m1.telephone AS auteur_telephone, m1.statut_id AS auteur_statut_id, s1.nom AS auteur_statut_nom, e.location_id, l.environnement_id AS location_environnement_id, env.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.departement_id AS location_departement_id, d.nom AS location_departement_nom, d.region_id AS location_departement_region_id, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m2.pseudo AS location_proprietaire_pseudo, m2.mot_de_passe AS location_proprietaire_mot_de_passe, m2.prenom AS location_proprietaire_prenom, m2.nom AS location_proprietaire_nom, m2.adresse AS location_proprietaire_adresse, m2.code_postal AS location_proprietaire_code_postal, m2.ville AS location_proprietaire_ville, m2.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m2.email AS location_proprietaire_email, m2.telephone AS location_proprietaire_telephone, m2.statut_id AS location_proprietaire_statut_id, s2.nom AS location_proprietaire_statut_nom "
                . "FROM evaluation AS e "
                . "INNER JOIN membre AS m1 ON e.auteur_id = m1.id "
                . "INNER JOIN pays AS p1 ON m1.pays_id = p1.id "
                . "INNER JOIN statut_membre AS s1 ON m1.statut_id = s1.id "
                . "INNER JOIN location AS l ON e.location_id = l.id "
                . "INNER JOIN environnement AS env ON l.environnement_id = env.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN departement AS d ON l.departement_id = d.id "
                . "INNER JOIN membre AS m2 ON l.proprietaire_id = m2.id "
                . "INNER JOIN pays AS p2 ON m2.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s2 ON m2.statut_id = s2.id"
                . "WHERE e.id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        $environnement_location = new Environnement($resultat->location_environnement_id, $resultat->location_environnement_nom);
        $type_location = new Type($resultat->location_type_id, $resultat->location_type_nom);
        $departement_location = new Departement($resultat->location_departement_id, $resultat->location_departement_nom, $resultat->location_departement_region_id);
        $pays_proprietaire = new Pays($resultat->location_proprietaire_pays_id, $resultat->location_proprietaire_pays_determinant, $resultat->location_proprietaire_pays_nom1, $resultat->location_proprietaire_pays_nom2, $resultat->location_proprietaire_pays_nom3);
        $statut_proprietaire = new Statut_membre($resultat->location_proprietaire_statut_id, $resultat->location_proprietaire_statut_nom);
        $proprietaire = new Membre($resultat->location_proprietaire_id, $resultat->location_proprietaire_pseudo, $resultat->location_proprietaire_mot_de_passe, $resultat->location_proprietaire_prenom, $resultat->location_proprietaire_nom, $resultat->location_proprietaire_adresse, $resultat->location_proprietaire_code_postal, $resultat->location_proprietaire_ville, $pays_proprietaire, $resultat->location_proprietaire_email, $resultat->location_proprietaire_telephone, $statut_proprietaire);
        $location = new Location($resultat->location_id, $environnement_location, $type_location, $resultat->location_code_postal, $resultat->location_ville, $departement_location, $resultat->location_surface_habitable, $resultat->location_surface_terrain, $resultat->location_nb_max_personnes, $proprietaire);
        $pays_auteur = new Pays($resultat->auteur_pays_id, $resultat->auteur_pays_determinant, $resultat->auteur_pays_nom1, $resultat->auteur_pays_nom2, $resultat->auteur_pays_nom3);
        $statut_auteur = new Statut_membre($resultat->auteur_statut_id, $resultat->auteur_statut_nom);
        $auteur = new Membre($resultat->auteur_id, $resultat->auteur_pseudo, $resultat->auteur_mot_de_passe, $resultat->auteur_prenom, $resultat->auteur_nom, $resultat->auteur_adresse, $resultat->auteur_code_postal, $resultat->auteur_ville, $pays_auteur, $resultat->auteur_email, $resultat->auteur_telephone, $statut_auteur);
        $evaluation = new Evaluation($resultat->id, $resultat->note, $resultat->texte, $resultat->date_evaluation, $auteur, $location);

	return $evaluation;
    }

    /**
     * Compter toutes les évaluations d'une location
     * @param int $id Identifiant de la location
     * @return int $nbDEvaluations
     */
    public static function compterTousDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT COUNT(*) "
                . "FROM evaluation AS e "
                . "INNER JOIN location AS l ON e.location_id = l.id "
                . "WHERE l.id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
	
        $nbDEvaluations = $req->fetchColumn();
		   
	return $nbDEvaluations;
        
    }
    
    /**
     * Calculer la moyene des notes des évaluation d'une location
     * @param int $id Identifiant de la location
     * @return float $moyenneNotes
     */
    public static function calculerMoyennedesNotesDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
        
	$req = $pdo->prepare(
                "SELECT AVG(e.note) AS moyenne_notes "
                . "FROM evaluation AS e "
                . "INNER JOIN location AS l ON e.location_id = l.id "
                . "WHERE l.id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
	
        $moyenneNotes = $req->fetchColumn();
		   
	return $moyenneNotes;
        
    }
    
    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
