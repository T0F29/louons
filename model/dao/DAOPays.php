<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use \Locations\Model\Entities\Pays;

require_once(dirname(__FILE__).'/BDD.php');
require_once(dirname(__FILE__).'/../entities/Pays.php');

class DAOPays {
    
    /**
     * Récupérer tous les pays par ordre alphabétique
     * @return array $listeTousPays
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                'SELECT id, determinant, nom1, nom2, nom3 '
                . 'FROM pays '
                . 'ORDER BY nom1 ASC');
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeTousPays = array();
        foreach ($resultats as $donnee) {
            
            $pays = new Pays();
            $pays->setId($donnee->id);
            $pays->setDeterminant($donnee->determinant);
            $pays->setNom1($donnee->nom1);
            $pays->setNom2($donnee->nom2);
            $pays->setNom3($donnee->nom3);
            
            array_push($listeTousPays, $pays);
        }
		   
	return $listeTousPays;
        
    }
    
    /**
     * Récupérer un pays par son identifiant
     * @param String $id Identifiant du pays
     * @return Pays $pays
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                'SELECT id, determinant, nom1, nom2, nom3 '
                . 'FROM pays '
                . 'WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        if (!$resultat) {
            return null;
        }
        else {
            $pays = new Pays();
            $pays->setId($resultat->id);
            $pays->setDeterminant($resultat->determinant);
            $pays->setNom1($resultat->nom1);
            $pays->setNom2($resultat->nom2);
            $pays->setNom3($resultat->nom3);

            return $pays;
        }
        
    }
    
    static function ajouteruneAnnonce($annonce){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            INSERT INTO playlist_track ( playlist_id, track_id)
                VALUES (:playlist_id, :track_id)');
        $stmt->bindValue(':playlist_id', $playlist_id, PDO::PARAM_INT);
        $stmt->bindValue(':track_id', $track_id, PDO::PARAM_INT);

        return $stmt->execute();
       
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

    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
