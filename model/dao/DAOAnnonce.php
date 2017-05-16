<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Annonce;
use Locations\Model\Entities\Environnement;
use Locations\Model\Entities\Location;
use Locations\Model\Entities\Membre;
use Locations\Model\Entities\Pays;
use Locations\Model\Entities\Statut_membre;
use Locations\Model\Entities\Subdivision1;
use Locations\Model\Entities\Subdivision2;
use Locations\Model\Entities\Type;
use Locations\Model\Dao\DAOLocation;


class DAOAnnonce {
    
    /**
     * Récupérer toutes les annonces
     * @return array $listeToutesannonces
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                "SELECT a.id, a.titre, a.contenu, a.date_annonce, l.id AS location_id, l.environnement_id AS location_environnement_id, e.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.subdivision2_id AS location_subdivision2_id, sub2.nom AS location_subdivision2_nom, l.subdivision1_id AS location_subdivision1_id, sub1.nom AS location_subdivision1_nom, l.pays_id AS location_pays_id, p1.determinant AS location_pays_determinant, p1.nom1 AS location_pays_nom1, p1.nom2 AS location_pays_nom2, p1.nom3 AS location_pays_nom3, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m.pseudo AS location_proprietaire_pseudo, m.mot_de_passe_hashe AS location_proprietaire_mot_de_passe_hashe, m.prenom AS location_proprietaire_prenom, m.nom AS location_proprietaire_nom, m.adresse AS location_proprietaire_adresse, m.code_postal AS location_proprietaire_code_postal, m.ville AS location_proprietaire_ville, m.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m.email AS location_proprietaire_email, m.telephone AS location_proprietaire_telephone, m.statut_id AS location_proprietaire_statut_id, s.nom AS location_proprietaire_statut_nom "
                . "FROM annonce AS a "
                . "INNER JOIN location AS l ON a.location_id = l.id "
                . "INNER JOIN environnement AS e ON l.environnement_id = e.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN subdivision2 AS sub2 ON l.subdivision2_id = sub2.id "
                . "INNER JOIN subdivision1 AS sub1 ON l.subdivision1_id = sub1.id "
                . "INNER JOIN pays AS p1 ON l.pays_id = p1.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "INNER JOIN pays AS p2 ON m.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s ON m.statut_id = s.id "
                . "ORDER BY a.date_annonce DESC");
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
		   
        $listeToutesAnnonces = array();
        foreach ($resultats as $donnee) {
            
            $environnement_location = new Environnement();
            $environnement_location->setId($donnee->location_environnement_id);
            $environnement_location->setNom($donnee->location_environnement_nom);
            
            $type_location = new Type();
            $type_location->setId($donnee->location_type_id);
            $type_location->setNom($donnee->location_type_nom);
            
            $subdivision2_location = new Subdivision2();
            $subdivision2_location->setId($donnee->location_subdivision2_id);
            $subdivision2_location->setNom($donnee->location_subdivision2_nom);
            
            $subdivision1_location = new Subdivision1();
            $subdivision1_location->setId($donnee->location_subdivision1_id);
            $subdivision1_location->setNom($donnee->location_subdivision1_nom);
            
            $pays_location = new Pays();
            $pays_location->setId($donnee->location_pays_id);
            $pays_location->setDeterminant($donnee->location_pays_determinant);
            $pays_location->setNom1($donnee->location_pays_nom1);
            $pays_location->setNom2($donnee->location_pays_nom2);
            $pays_location->setNom3($donnee->location_pays_nom3);
            
            $pays_proprio = new Pays();
            $pays_proprio->setId($donnee->location_proprietaire_pays_id);
            $pays_proprio->setDeterminant($donnee->location_proprietaire_pays_determinant);
            $pays_proprio->setNom1($donnee->location_proprietaire_pays_nom1);
            $pays_proprio->setNom2($donnee->location_proprietaire_pays_nom2);
            $pays_proprio->setNom3($donnee->location_proprietaire_pays_nom3);
            
            $statut_proprio = new Statut_membre();
            $statut_proprio->setId($donnee->location_proprietaire_statut_id);
            $statut_proprio->setNom($donnee->location_proprietaire_statut_nom);
            
            $proprio = new Membre();
            $proprio->setId($donnee->location_proprietaire_id);
            $proprio->setPseudo($donnee->location_proprietaire_pseudo);
            $proprio->setMot_de_passe_hashe($donnee->location_proprietaire_mot_de_passe_hashe);
            $proprio->setPrenom($donnee->location_proprietaire_prenom);
            $proprio->setNom($donnee->location_proprietaire_nom);
            $proprio->setAdresse($donnee->location_proprietaire_adresse);
            $proprio->setCode_postal($donnee->location_proprietaire_code_postal);
            $proprio->setVille($donnee->location_proprietaire_ville);
            $proprio->setPays($pays_proprio);
            $proprio->setEmail($donnee->location_proprietaire_email);
            $proprio->setTelephone($donnee->location_proprietaire_telephone);
            $proprio->setStatut($statut_proprio);
            
            $location = new Location();
            $location->setId($donnee->location_id);
            $location->setEnvironnement($environnement_location);
            $location->setType($type_location);
            $location->setCode_postal($donnee->location_code_postal);
            $location->setVille($donnee->location_ville);
            $location->setSubdivision2($subdivision2_location);
            $location->setSubdivision1($subdivision1_location);
            $location->setPays($pays_location);
            $location->setSurface_habitable($donnee->location_surface_habitable);
            $location->setSurface_terrain($donnee->location_surface_terrain);
            $location->setNb_max_personnes($donnee->location_nb_max_personnes);
            $location->setProprietaire($proprio);
            
            $annonce = new Annonce();
            $annonce->setId($donnee->id);
            $annonce->setTitre($donnee->titre);
            $annonce->setContenu($donnee->contenu);
            $annonce->setDate_annonce($donnee->date_annonce);
            $annonce->setLocation($location);
            
            array_push($listeToutesAnnonces, $annonce);
        }
		   
	return $listeToutesAnnonces;
    }  
    
    /**
     * Récupérer toutes les annonces d'un propriétaire
     * @param int $id_proprietaire Identifiant d'un membre
     * @return array $listeToutesannonces
     */
    public static function recupererTousDUnProprietaire($id_proprietaire) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT a.id, a.titre, a.contenu, a.date_annonce, l.id AS location_id, l.environnement_id AS location_environnement_id, e.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.subdivision2_id AS location_subdivision2_id, sub2.nom AS location_subdivision2_nom, l.subdivision1_id AS location_subdivision1_id, sub1.nom AS location_subdivision1_nom, l.pays_id AS location_pays_id, p1.determinant AS location_pays_determinant, p1.nom1 AS location_pays_nom1, p1.nom2 AS location_pays_nom2, p1.nom3 AS location_pays_nom3, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m.pseudo AS location_proprietaire_pseudo, m.mot_de_passe_hashe AS location_proprietaire_mot_de_passe_hashe, m.prenom AS location_proprietaire_prenom, m.nom AS location_proprietaire_nom, m.adresse AS location_proprietaire_adresse, m.code_postal AS location_proprietaire_code_postal, m.ville AS location_proprietaire_ville, m.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m.email AS location_proprietaire_email, m.telephone AS location_proprietaire_telephone, m.statut_id AS location_proprietaire_statut_id, s.nom AS location_proprietaire_statut_nom "
                . "FROM annonce AS a "
                . "INNER JOIN location AS l ON a.location_id = l.id "
                . "INNER JOIN environnement AS e ON l.environnement_id = e.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN subdivision2 AS sub2 ON l.subdivision2_id = sub2.id "
                . "INNER JOIN subdivision1 AS sub1 ON l.subdivision1_id = sub1.id "
                . "INNER JOIN pays AS p1 ON l.pays_id = p1.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "INNER JOIN pays AS p2 ON m.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s ON m.statut_id = s.id "
                . "WHERE m.id = :id");
        $req->bindValue(':id', $id_proprietaire);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
		   
        $listeToutesAnnonces = array();
        foreach ($resultats as $donnee) {
            
            $environnement_location = new Environnement();
            $environnement_location->setId($donnee->location_environnement_id);
            $environnement_location->setNom($donnee->location_environnement_nom);
            
            $type_location = new Type();
            $type_location->setId($donnee->location_type_id);
            $type_location->setNom($donnee->location_type_nom);
            
            $subdivision2_location = new Subdivision2();
            $subdivision2_location->setId($donnee->location_subdivision2_id);
            $subdivision2_location->setNom($donnee->location_subdivision2_nom);
            
            $subdivision1_location = new Subdivision1();
            $subdivision1_location->setId($donnee->location_subdivision1_id);
            $subdivision1_location->setNom($donnee->location_subdivision1_nom);
            
            $pays_location = new Pays();
            $pays_location->setId($donnee->location_pays_id);
            $pays_location->setDeterminant($donnee->location_pays_determinant);
            $pays_location->setNom1($donnee->location_pays_nom1);
            $pays_location->setNom2($donnee->location_pays_nom2);
            $pays_location->setNom3($donnee->location_pays_nom3);
            
            $pays_proprio = new Pays();
            $pays_proprio->setId($donnee->location_proprietaire_pays_id);
            $pays_proprio->setDeterminant($donnee->location_proprietaire_pays_determinant);
            $pays_proprio->setNom1($donnee->location_proprietaire_pays_nom1);
            $pays_proprio->setNom2($donnee->location_proprietaire_pays_nom2);
            $pays_proprio->setNom3($donnee->location_proprietaire_pays_nom3);
                    
            $statut_proprio = new Statut_membre();
            $statut_proprio->setId($donnee->location_proprietaire_statut_id);
            $statut_proprio->setNom($donnee->location_proprietaire_statut_nom);
            
            $proprio = new Membre();
            $proprio->setId($donnee->location_proprietaire_id);
            $proprio->setPseudo($donnee->location_proprietaire_pseudo);
            $proprio->setMot_de_passe_hashe($donnee->location_proprietaire_mot_de_passe_hashe);
            $proprio->setPrenom($donnee->location_proprietaire_prenom);
            $proprio->setNom($donnee->location_proprietaire_nom);
            $proprio->setAdresse($donnee->location_proprietaire_adresse);
            $proprio->setCode_postal($donnee->location_proprietaire_code_postal);
            $proprio->setVille($donnee->location_proprietaire_ville);
            $proprio->setPays($pays_proprio);
            $proprio->setEmail($donnee->location_proprietaire_email);
            $proprio->setTelephone($donnee->location_proprietaire_telephone);
            $proprio->setStatut($statut_proprio);
            
            $location = new Location();
            $location->setId($donnee->location_id);
            $location->setEnvironnement($environnement_location);
            $location->setType($type_location);
            $location->setCode_postal($donnee->location_code_postal);
            $location->setVille($donnee->location_ville);
            $location->setSubdivision2($subdivision2_location);
            $location->setSubdivision1($subdivision1_location);
            $location->setPays($pays_location);
            $location->setSurface_habitable($donnee->location_surface_habitable);
            $location->setSurface_terrain($donnee->location_surface_terrain);
            $location->setNb_max_personnes($donnee->location_nb_max_personnes);
            $location->setProprietaire($proprio);
            
            $annonce = new Annonce();
            $annonce->setId($donnee->id);
            $annonce->setTitre($donnee->titre);
            $annonce->setContenu($donnee->contenu);
            $annonce->setDate_annonce($donnee->date_annonce);
            $annonce->setLocation($location);
            
            array_push($listeToutesAnnonces, $annonce);
        }
		   
	return $listeToutesAnnonces;
    }

    /**
     * Récupérer toutes les annonces d'un propriétaire
     * @param int $id_proprietaire Identifiant d'un membre
     * @return array $listeToutesannonces
     */
    public static function compterTousDUnProprietaire($id_proprietaire) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT COUNT(*) "
                . "FROM annonce AS a "
                . "INNER JOIN location AS l ON a.location_id = l.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "WHERE m.id = :id");
        $req->bindValue(':id', $id_proprietaire);
        $req->execute();
        
        $nbAnnonces = $req->fetchColumn();
		   
	return $nbAnnonces;
    }

    
    /**
     * Récupérer une annonce par son identifiant
     * @param int $id Identifiant de l'annonce
     * @return Annonce $annonce
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT a.id, a.titre, a.contenu, a.date_annonce, l.id AS location_id, l.environnement_id AS location_environnement_id, e.nom AS location_environnement_nom, l.type_id AS location_type_id, t.nom AS location_type_nom, l.code_postal AS location_code_postal, l.ville AS location_ville, l.subdivision2_id AS location_subdivision2_id, sub2.nom AS location_subdivision2_nom, l.subdivision1_id AS location_subdivision1_id, sub1.nom AS location_subdivision1_nom, l.pays_id AS location_pays_id, p1.determinant AS location_pays_determinant, p1.nom1 AS location_pays_nom1, p1.nom2 AS location_pays_nom2, p1.nom3 AS location_pays_nom3, l.surface_habitable AS location_surface_habitable, l.surface_terrain AS location_surface_terrain, l.nb_max_personnes AS location_nb_max_personnes, l.proprietaire_id AS location_proprietaire_id, m.pseudo AS location_proprietaire_pseudo, m.mot_de_passe_hashe AS location_proprietaire_mot_de_passe_hashe, m.prenom AS location_proprietaire_prenom, m.nom AS location_proprietaire_nom, m.adresse AS location_proprietaire_adresse, m.code_postal AS location_proprietaire_code_postal, m.ville AS location_proprietaire_ville, m.pays_id AS location_proprietaire_pays_id, p2.determinant AS location_proprietaire_pays_determinant, p2.nom1 AS location_proprietaire_pays_nom1, p2.nom2 AS location_proprietaire_pays_nom2, p2.nom3 AS location_proprietaire_pays_nom3, m.email AS location_proprietaire_email, m.telephone AS location_proprietaire_telephone, m.statut_id AS location_proprietaire_statut_id, s.nom AS location_proprietaire_statut_nom "
                . "FROM annonce AS a "
                . "INNER JOIN location AS l ON a.location_id = l.id "
                . "INNER JOIN environnement AS e ON l.environnement_id = e.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN subdivision2 AS sub2 ON l.subdivision2_id = sub2.id "
                . "INNER JOIN subdivision1 AS sub1 ON l.subdivision1_id = sub1.id "
                . "INNER JOIN pays AS p1 ON l.pays_id = p1.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "INNER JOIN pays AS p2 ON m.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s ON m.statut_id = s.id "
                . "WHERE a.id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();

        $environnement_location = new Environnement();
        $environnement_location->setId($resultat->location_environnement_id);
        $environnement_location->setNom($resultat->location_environnement_nom);
        
        $type_location = new Type();
        $type_location->setId($resultat->location_type_id);
        $type_location->setNom($resultat->location_type_nom);
        
        $subdivision2_location = new Subdivision2();
        $subdivision2_location->setId($resultat->location_subdivision2_id);
        $subdivision2_location->setNom($resultat->location_subdivision2_nom);
        
        $subdivision1_location = new Subdivision1();
        $subdivision1_location->setId($resultat->location_subdivision1_id);
        $subdivision1_location->setNom($resultat->location_subdivision1_nom);
        
        $pays_location = new Pays();
        $pays_location->setId($resultat->location_pays_id);
        $pays_location->setDeterminant($resultat->location_pays_determinant);
        $pays_location->setNom1($resultat->location_pays_nom1);
        $pays_location->setNom2($resultat->location_pays_nom2);
        $pays_location->setNom3($resultat->location_pays_nom3);
        
        $pays_proprio = new Pays();
        $pays_proprio->setId($resultat->location_proprietaire_pays_id);
        $pays_proprio->setDeterminant($resultat->location_proprietaire_pays_determinant);
        $pays_proprio->setNom1($resultat->location_proprietaire_pays_nom1);
        $pays_proprio->setNom2($resultat->location_proprietaire_pays_nom2);
        $pays_proprio->setNom3($resultat->location_proprietaire_pays_nom3);
        
        $statut_proprio = new Statut_membre();
        $statut_proprio->setId($resultat->location_proprietaire_statut_id);
        $statut_proprio->setNom($resultat->location_proprietaire_statut_nom);
        
        $proprio = new Membre();
        $proprio->setId($resultat->location_proprietaire_id);
        $proprio->setPseudo($resultat->location_proprietaire_pseudo);
        $proprio->setMot_de_passe_hashe($resultat->location_proprietaire_mot_de_passe_hashe);
        $proprio->setPrenom($resultat->location_proprietaire_prenom);
        $proprio->setNom($resultat->location_proprietaire_nom);
        $proprio->setAdresse($resultat->location_proprietaire_adresse);
        $proprio->setCode_postal($resultat->location_proprietaire_code_postal);
        $proprio->setVille($resultat->location_proprietaire_ville);
        $proprio->setPays($pays_proprio);
        $proprio->setEmail($resultat->location_proprietaire_email);
        $proprio->setTelephone($resultat->location_proprietaire_telephone);
        $proprio->setStatut($statut_proprio);
        
        $location = new Location();
        $location->setId($resultat->location_id);
        $location->setEnvironnement($environnement_location);
        $location->setType($type_location);
        $location->setCode_postal($resultat->location_code_postal);
        $location->setVille($resultat->location_ville);
        $location->setSubdivision2($subdivision2_location);
        $location->setSubdivision1($subdivision1_location);
        $location->setPays($pays_location);
        $location->setSurface_habitable($resultat->location_surface_habitable);
        $location->setSurface_terrain($resultat->location_surface_terrain);
        $location->setNb_max_personnes($resultat->location_nb_max_personnes);
        $location->setProprietaire($proprio);
        
        $annonce = new Annonce();
        $annonce->setId($resultat->id);
        $annonce->setTitre($resultat->titre);
        $annonce->setContenu($resultat->contenu);
        $annonce->setDate_annonce($resultat->date_annonce);
        $annonce->setLocation($location);

	return $annonce;
    }
    
    /**
     * Vérifier si une annonce appartient à un membre
     * @param type $idAnnonce
     * @param type $idMembre
     * @return vrai si annonce appartient à ce membre
     */
    public static function verifierSiAnnonceAppartientAMembre($idAnnonce, $idMembre){
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare(
                "SELECT COUNT(*) "
                . "FROM annonce AS a "
                . "INNER JOIN location AS l ON a.location_id = l.id "
                . "WHERE a.id = :id_annonce AND l.proprietaire_id = :id_membre");
        $req->bindValue(':id_annonce', $idAnnonce);
        $req->bindValue(':id_membre', $idMembre);
        $req->execute();
	$res = $req->fetchColumn();
        return ($res>0);
    }
    
    /**
     * Ajouter une annonce
     * @param Annonce $annonce Annonce à ajouter
     * @return -1 si erreur et $annonce->id sinon
     */
    public static function ajouterUn($annonce) {
        
        $pdo = BDD::recupererConnexion();
        
        $ajoutLocation = DAOLocation::AjouterUn($annonce->getLocation());
        
        if ($ajoutLocation == -1) {
            return -1;
        } else {
            $req = $pdo->prepare('
                INSERT INTO annonce (id, titre, contenu, date_annonce, location_id)
                    VALUES (:id, :titre, :contenu, :date_annonce, :location_id)');
            
            $req->bindValue(':id', $ajoutLocation, PDO::PARAM_INT);
            $req->bindValue(':titre', $annonce->getTitre(), PDO::PARAM_STR);
            $req->bindValue(':contenu', $annonce->getContenu(), PDO::PARAM_STR);
            $req->bindValue(':date_annonce', $annonce->getDate_annonce(), PDO::PARAM_STR);
            $req->bindValue(':location_id', $ajoutLocation, PDO::PARAM_INT);

            $res = $req->execute();
            if ($res) {
                return $pdo->lastInsertId();
            } else {
                return -1;
            }
        }
    }
    
    /**
     * Modifier une annonce
     * @param int $id Id de l'annonce à modifier
     * @param Annonce $nouvelleAnnonce Nouvelle annonce dont les données sont à prendre en compte
     * @return
     */
    public static function modifierUn($id, $nouvelleAnnonce) {
        
        $pdo = BDD::recupererConnexion();
        
        DAOLocation::ModifierUn($id, $nouvelleAnnonce->getLocation());
        
        $req = $pdo->prepare(
            'UPDATE annonce '
            . 'SET titre = :titre, contenu = :contenu, date_annonce = :date_annonce, location_id = :location_id '
            . 'WHERE id = :id');

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':titre', $nouvelleAnnonce->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $nouvelleAnnonce->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':date_annonce', $nouvelleAnnonce->getDate_annonce(), PDO::PARAM_STR);
        $req->bindValue(':location_id', $id, PDO::PARAM_INT);

        return $req->execute();
    }
    
    public static function supprimerUn($idAnnonce, $idMembre) {
        
        if (self::verifierSiAnnonceAppartientAMembre($idAnnonce,$idMembre)) {
        
            $pdo = BDD::recupererConnexion();

            $req = $pdo->prepare(
                    "DELETE "
                    . "FROM annonce "
                    . "WHERE id = :id_annonce");
            $req->bindValue(':id_annonce', $idAnnonce);

            return $req->execute();
        } else {
            throw new \Exception("L'annonce ".$idAnnonce."n'appartient pas au membre ".$idMembre);
        }
    }
    
    static function verifierSiDocumentEstCd($document_id){
        
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare("SELECT count(*) FROM cd WHERE document_id = :document_id");
        $stmt->bindValue(':document_id', $document_id);
        $stmt->execute();
	$res = $stmt->fetchColumn();
        return ($res>0);
    }  
   
    /**
    *
    *@return last inserted id or -1 if any problem
    **/
    static function save(PlayList $playList){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            INSERT INTO playlist ( name, description, user_id, picture)
                VALUES (:name, :description, :user_id, :picture)');
        $stmt->bindValue(':name', $playList->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $playList->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $playList->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(':picture', $playList->getPicture(), PDO::PARAM_STR);
        $res = $stmt->execute();
        if ($res){
            return $pdo->lastInsertId();
        }else {
            return -1;
        }
        
    }

    
    static function  getPlayLists($userid){
       // connection BDD
	$pdo = DB::getConnection();
	
			
	$stmt = $pdo->prepare("SELECT * FROM playlist WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $userid);
        $stmt->execute();

	$pls = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, PlayList::class);
		   
	return $pls;
          
    }
    
    static function getPlayListById($playlist_id){
        $pdo = DB::getConnection();
	
			
	$stmt = $pdo->prepare("SELECT * FROM playlist WHERE id = :playlist_id");
        $stmt->bindValue(':playlist_id', $playlist_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, PlayList::class);
	$pl = $stmt->fetch();


	return $pl;
    }
    
     static function getTracks($playlist_id){
        $pdo = DB::getConnection();
	
			
	$stmt = $pdo->prepare("SELECT * FROM track inner join playlist_track on track.id = playlist_track.track_id WHERE playlist_track.playlist_id = :playlist_id");
        $stmt->bindValue(':playlist_id', $playlist_id);
        $stmt->execute();

	$playLists = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, \PlayStore\Model\Entities\Track::class);
		   
	return $playLists;
    }
    
    static function addTrack($playlist_id, $track_id){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            INSERT INTO playlist_track ( playlist_id, track_id)
                VALUES (:playlist_id, :track_id)');
        $stmt->bindValue(':playlist_id', $playlist_id, PDO::PARAM_INT);
        $stmt->bindValue(':track_id', $track_id, PDO::PARAM_INT);

        return $stmt->execute();
        
    }


}
