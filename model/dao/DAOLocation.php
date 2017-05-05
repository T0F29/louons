<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Environnement;
use Locations\Model\Entities\Location;
use Locations\Model\Entities\Membre;
use Locations\Model\Entities\Pays;
use Locations\Model\Entities\Statut_membre;
use Locations\Model\Entities\Subdivision1;
use Locations\Model\Entities\Subdivision2;
use Locations\Model\Entities\Type;

require_once(dirname(__FILE__).'/BDD.php');
require_once(dirname(__FILE__).'/../entities/Environnement.php');
require_once(dirname(__FILE__).'/../entities/Type.php');
require_once(dirname(__FILE__).'/../entities/Subdivision1.php');
require_once(dirname(__FILE__).'/../entities/Subdivision2.php');
require_once(dirname(__FILE__).'/../entities/Pays.php');
require_once(dirname(__FILE__).'/../entities/Statut_membre.php');
require_once(dirname(__FILE__).'/../entities/Membre.php');
require_once(dirname(__FILE__).'/../entities/Location.php');

class DAOLocation {
    
    /**
     * Récupérer toutes les locations
     * @return array $listeToutesLocations
     */
    public static function recupererTous() {
     
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                "SELECT l.id, l.environnement_id, e.nom AS environnement_nom, l.type_id, t.nom AS type_nom, l.code_postal, l.ville, l.subdivision2_id, s2.nom AS subdivision2_nom, l.subdivision1_id, s1.nom AS subdivision1_nom, l.pays_id, p1.determinant AS pays_determinant, p1.nom1 AS pays_nom1, p1.nom2 AS pays_nom2, p1.nom3 AS pays_nom3, l.surface_habitable, l.surface_terrain, l.nb_max_personnes, l.proprietaire_id, m.pseudo AS proprietaire_pseudo, m.mot_de_passe_hashe AS proprietaire_mot_de_passe_hashe, m.prenom AS proprietaire_prenom, m.nom AS proprietaire_nom, m.adresse AS proprietaire_adresse, m.code_postal AS proprietaire_code_postal, m.ville AS proprietaire_ville, m.pays_id AS proprietaire_pays_id, p2.determinant AS proprietaire_pays_determinant, p2.nom1 AS proprietaire_pays_nom1, p2.nom2 AS proprietaire_pays_nom2, p2.nom3 AS proprietaire_pays_nom3, m.email AS proprietaire_email, m.telephone AS proprietaire_telephone, m.statut_id AS proprietaire_statut_id, s.nom AS proprietaire_statut_nom "
                . "FROM location AS l "
                . "INNER JOIN environnement AS e ON l.environnement_id = e.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN subdivision2 AS s2 ON l.subdivision2_id = s2.id "
                . "INNER JOIN subdivision1 AS s1 ON l.subdivision1_id = s1.id "
                . "INNER JOIN pays AS p1 ON l.pays_id = p1.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "INNER JOIN pays AS p2 ON m.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s ON m.statut_id = s.id"
                . "");
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesLocations = array();
        foreach ($resultats as $donnee) {
            
            $environnement = new Environnement();
            $environnement->setId($donnee->environnement_id);
            $environnement->setNom($donnee->environnement_nom);
            
            $type = new Type();
            $type->setId($donnee->type_id);
            $type->setNom($donnee->type_nom);
            
            $subdivision2 = new Subdivision2();
            $subdivision2->setId($donnee->subdivision2_id);
            $subdivision2->setNom($donnee->subdivision2_nom);
            
            $subdivision1 = new Subdivision1();
            $subdivision1->setId($donnee->subdivision1_id);
            $subdivision1->setNom($donnee->subdivision1_nom);
            
            $pays = new Pays();
            $pays->setId($donnee->pays_id);
            $pays->setDeterminant($donnee->pays_determinant);
            $pays->setNom1($donnee->pays_nom1);
            $pays->setNom2($donnee->pays_nom2);
            $pays->setNom3($donnee->pays_nom3);
            
            $pays_proprietaire = new Pays();
            $pays_proprietaire->setId($donnee->proprietaire_pays_id);
            $pays_proprietaire->setDeterminant($donnee->proprietaire_pays_determinant);
            $pays_proprietaire->setNom1($donnee->proprietaire_pays_nom1);
            $pays_proprietaire->setNom2($donnee->proprietaire_pays_nom2);
            $pays_proprietaire->setNom3($donnee->proprietaire_pays_nom3);
            
            $statut_proprietaire = new Statut_membre();
            $statut_proprietaire->setId($donnee->proprietaire_statut_id);
            $statut_proprietaire->setNom($donnee->proprietaire_statut_nom);
            
            $proprietaire = new Membre();
            $proprietaire->setId($donnee->proprietaire_id);
            $proprietaire->setPseudo($donnee->proprietaire_pseudo);
            $proprietaire->setMot_de_passe_hashe($donnee->proprietaire_mot_de_passe_hashe);
            $proprietaire->setPrenom($donnee->proprietaire_prenom);
            $proprietaire->setNom($donnee->proprietaire_nom);
            $proprietaire->setAdresse($donnee->proprietaire_adresse);
            $proprietaire->setCode_postal($donnee->proprietaire_code_postal);
            $proprietaire->setVille($donnee->proprietaire_ville);
            $proprietaire->setPays($pays_proprietaire);
            $proprietaire->setEmail($donnee->proprietaire_email);
            $proprietaire->setTelephone($donnee->proprietaire_telephone);
            $proprietaire->setStatut($statut_proprietaire);
            
            $location = new Location();
            $location->setId($donnee->id);
            $location->setEnvironnement($environnement);
            $location->setType($type);
            $location->setCode_postal($donnee->code_postal);
            $location->setVille($donnee->ville);
            $location->setSubdivision2($subdivision2);
            $location->setSubdivision1($subdivision1);
            $location->setPays($pays);
            $location->setSurface_habitable($donnee->surface_habitable);
            $location->setSurface_terrain($donnee->surface_terrain);
            $location->setNb_max_personnes($donnee->nb_max_personnes);
            $location->setProprietaire($proprietaire);
            
            array_push($listeToutesLocations, $location);
        }
		   
	return $listeToutesLocations;
    }
   
    
    /**
     * Récupérer une location par son identifiant
     * @param int $id Identifiant de la location
     * @return Location $location
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = DB::getConnection();
			
	$req = $pdo->prepare(
                "SELECT l.id, l.environnement_id, e.nom AS environnement_nom, l.type_id, t.nom AS type_nom, l.code_postal, l.ville, l.subdivision2_id, s2.nom AS subdivision2_nom, l.subdivision1_id, s1.nom AS subdivision1_nom, l.pays_id, p1.determinant AS pays_determinant, p1.nom1 AS pays_nom1, p1.nom2 AS pays_nom2, p1.nom3 AS pays_nom3, l.surface_habitable, l.surface_terrain, l.nb_max_personnes, l.proprietaire_id, m.pseudo AS proprietaire_pseudo, m.mot_de_passe_hashe AS proprietaire_mot_de_passe_hashe, m.prenom AS proprietaire_prenom, m.nom AS proprietaire_nom, m.adresse AS proprietaire_adresse, m.code_postal AS proprietaire_code_postal, m.ville AS proprietaire_ville, m.pays_id AS proprietaire_pays_id, p2.determinant AS proprietaire_pays_determinant, p2.nom1 AS proprietaire_pays_nom1, p2.nom2 AS proprietaire_pays_nom2, p2.nom3 AS proprietaire_pays_nom3, m.email AS proprietaire_email, m.telephone AS proprietaire_telephone, m.statut_id AS proprietaire_statut_id, s.nom AS proprietaire_statut_nom "
                . "FROM location AS l "
                . "INNER JOIN environnement AS e ON l.environnement_id = e.id "
                . "INNER JOIN type AS t ON l.type_id = t.id "
                . "INNER JOIN subdivision2 AS s2 ON l.subdivision2_id = s2.id "
                . "INNER JOIN subdivision1 AS s1 ON l.subdivision1_id = s1.id "
                . "INNER JOIN pays AS p1 ON l.pays_id = p1.id "
                . "INNER JOIN membre AS m ON l.proprietaire_id = m.id "
                . "INNER JOIN pays AS p2 ON m.pays_id = p2.id "
                . "INNER JOIN statut_membre AS s ON m.statut_id = s.id"
                . "WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        $environnement = new Environnement();
        $environnement->setId($resultat->environnement_id);
        $environnement->setNom($resultat->environnement_nom);
            
        $type = new Type();
        $type->setId($resultat->type_id);
        $type->setNom($resultat->type_nom);

        $subdivision2 = new Subdivision2();
        $subdivision2->setId($resultat->subdivision2_id);
        $subdivision2->setNom($resultat->subdivision2_nom);
        
        $subdivision1 = new Subdivision1();
        $subdivision1->setId($resultat->subdivision1_id);
        $subdivision1->setNom($resultat->subdivision1_nom);
        
        $pays = new Pays();
        $pays->setId($resultat->pays_id);
        $pays->setDeterminant($resultat->pays_determinant);
        $pays->setNom1($resultat->pays_nom1);
        $pays->setNom2($resultat->pays_nom2);
        $pays->setNom3($resultat->pays_nom3);

        $pays_proprietaire = new Pays();
        $pays_proprietaire->setId($resultat->proprietaire_pays_id);
        $pays_proprietaire->setDeterminant($resultat->proprietaire_pays_determinant);
        $pays_proprietaire->setNom1($resultat->proprietaire_pays_nom1);
        $pays_proprietaire->setNom2($resultat->proprietaire_pays_nom2);
        $pays_proprietaire->setNom3($resultat->proprietaire_pays_nom3);
       
        $statut_proprietaire = new Statut_membre();
        $statut_proprietaire->setId($resultat->proprietaire_statut_id);
        $statut_proprietaire->setNom($resultat->proprietaire_statut_nom);

        $proprietaire = new Membre();
        $proprietaire->setId($resultat->proprietaire_id);
        $proprietaire->setPseudo($resultat->proprietaire_pseudo);
        $proprietaire->setMot_de_passe_hashe($resultat->proprietaire_mot_de_passe_hashe);
        $proprietaire->setPrenom($resultat->proprietaire_prenom);
        $proprietaire->setNom($resultat->proprietaire_nom);
        $proprietaire->setAdresse($resultat->proprietaire_adresse);
        $proprietaire->setCode_postal($resultat->proprietaire_code_postal);
        $proprietaire->setVille($resultat->proprietaire_ville);
        $proprietaire->setPays($pays_proprietaire);
        $proprietaire->setEmail($resultat->proprietaire_email);
        $proprietaire->setTelephone($resultat->proprietaire_telephone);
        $proprietaire->setStatut($statut_proprietaire);
        
        $location = new Location();
        $location->setId($resultat->id);
        $location->setEnvironnement($environnement);
        $location->setType($type);
        $location->setCode_postal($resultat->code_postal);
        $location->setVille($resultat->ville);
        $location->setSubdivision2($subdivision2);
        $location->setSubdivision1($subdivision1);
        $location->setPays($pays);
        $location->setSurface_habitable($resultat->surface_habitable);
        $location->setSurface_terrain($resultat->surface_terrain);
        $location->setNb_max_personnes($resultat->nb_max_personnes);
        $location->setProprietaire($proprietaire);

	return $location;
    }
    
    /**
     * Ajouter une location
     * @param Location $location Location à ajouter
     * @return -1 si erreur et $location->id sinon
     */
    public static function ajouterUn($location) {
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare('
            INSERT INTO location (environnement_id, type_id, code_postal, ville, subdivision2_id, subdivision1_id, pays_id, surface_habitable, surface_terrain, nb_max_personnes, proprietaire_id)
                VALUES (:environnement_id, :type_id, :code_postal, :ville, :subdivision2_id, :subdivision1_id, :pays_id, :surface_habitable, :surface_terrain, :nb_max_personnes, :proprietaire_id)');

        $req->bindValue(':environnement_id', $location->getEnvironnement()->getId(), PDO::PARAM_INT);
        $req->bindValue(':type_id', $location->getType()->getId(), PDO::PARAM_INT);
        $req->bindValue(':code_postal', $location->getCode_postal(), PDO::PARAM_STR);
        $req->bindValue(':ville', $location->getVille(), PDO::PARAM_STR);
        $req->bindValue(':subdivision2_id', $location->getSubdivision2()->getId(), PDO::PARAM_STR);
        $req->bindValue(':subdivision1_id', $location->getSubdivision1()->getId(), PDO::PARAM_STR);
        $req->bindValue(':pays_id', $location->getPays()->getId(), PDO::PARAM_STR);
        $req->bindValue(':surface_habitable', $location->getSurface_habitable(), PDO::PARAM_INT);
        $req->bindValue(':surface_terrain', $location->getSurface_terrain(), PDO::PARAM_INT);
        $req->bindValue(':nb_max_personnes', $location->getNb_max_personnes(), PDO::PARAM_INT);
        $req->bindValue(':proprietaire_id', $location->getProprietaire()->getId(), PDO::PARAM_INT);

        $res = $req->execute();
        if ($res){
            return $pdo->lastInsertId();
        }else {
            return -1;
        }
    }
    
    /**
     * Modifier une location
     * @param int $id Id de la location à modifier
     * @param Location $nouvelleLocation Nouvelle location dont les données sont à prendre en compte
     * @return -1 si erreur et $location->id sinon
     */
    public static function modifierUn($id, $nouvelleLocation) {
        
        $pdo = BDD::recupererConnexion();
        
        $req = $pdo->prepare(
            'UPDATE location '
            . 'SET environnement_id = :environnement_id, type_id = :type_id, code_postal = :code_postal, ville = :ville, subdivision2_id = :subdivision2_id, subdivision1_id = :subdivision1_id, pays_id = :pays_id, surface_habitable = :surface_habitable, surface_terrain = :surface_terrain, nb_max_personnes = :nb_max_personnes, proprietaire_id = :proprietaire_id '
            . 'WHERE id = :id');

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':environnement_id', $nouvelleLocation->getEnvironnement()->getId(), PDO::PARAM_INT);
        $req->bindValue(':type_id', $nouvelleLocation->getType()->getId(), PDO::PARAM_INT);
        $req->bindValue(':code_postal', $nouvelleLocation->getCode_postal(), PDO::PARAM_STR);
        $req->bindValue(':ville', $nouvelleLocation->getVille(), PDO::PARAM_STR);
        $req->bindValue(':subdivision2_id', $nouvelleLocation->getSubdivision2()->getId(), PDO::PARAM_STR);
        $req->bindValue(':subdivision1_id', $nouvelleLocation->getSubdivision1()->getId(), PDO::PARAM_STR);
        $req->bindValue(':pays_id', $nouvelleLocation->getPays()->getId(), PDO::PARAM_STR);
        $req->bindValue(':surface_habitable', $nouvelleLocation->getSurface_habitable(), PDO::PARAM_INT);
        $req->bindValue(':surface_terrain', $nouvelleLocation->getSurface_terrain(), PDO::PARAM_INT);
        $req->bindValue(':nb_max_personnes', $nouvelleLocation->getNb_max_personnes(), PDO::PARAM_INT);
        $req->bindValue(':proprietaire_id', $nouvelleLocation->getProprietaire()->getId(), PDO::PARAM_INT);

        return $req->execute();
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
    /**
     * check if playList belong to user
     * @param type $playListId
     * @param type $userId
     * @return boolean true if playListId belongs to userId
     */
    static function exist($playListId, $userId){
        
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare("SELECT count(*) FROM playlist WHERE id = :playlist_id AND user_id = :user_id");
        $stmt->bindValue(':playlist_id', $playListId);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
	$res = $stmt->fetchColumn();
        return ($res>0);
    }
    
    static function delete($playListId, $trackId, $userId){
        
        if (self::exist($playListId,$userId )){
        
            $pdo = DB::getConnection();

            $stmt = $pdo->prepare('DELETE FROM playlist_track WHERE playlist_id = :playlist_id AND track_id = :track_id');
            $stmt->bindValue(':playlist_id', $playListId);
            $stmt->bindValue(':track_id', $trackId);

            return $stmt->execute();
        }else{
            throw new \Exception("playlist id ". $playListId."is not owned by user id:" . $userId);
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

    public static function supprimerUn() {
        
    }

}
