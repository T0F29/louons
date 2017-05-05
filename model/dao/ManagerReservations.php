<?php

namespace Mediatheque\Model\Dao;

use \Mediatheque\Model\Entities\Reservation as Reservation;
use \PDO as PDO;

require_once(dirname(__FILE__).'/DB.php');
require_once(dirname(__FILE__).'/../entities/Reservation.class.php');

class ManagerReservations {

     static function recupererReservationsBds(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee IS NULL AND document.code_ref LIKE \'BD-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsCds(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee IS NULL AND document.code_ref LIKE \'CD-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsLivres(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee IS NULL AND document.code_ref LIKE \'LIV-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsBdsTraitees(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee=1 AND document.code_ref LIKE \'BD-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsCdsTraitees(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee=1 AND document.code_ref LIKE \'CD-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsLivresTraitees(){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.traitee=1 AND document.code_ref LIKE \'LIV-%\' ORDER BY date_reservation DESC');
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsBdsDUnUtilisateur($utilisateur_id){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'BD-%\' ORDER BY date_reservation DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $reservations = $stmt->execute();
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsCdsDUnUtilisateur($utilisateur_id){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'CD-%\' ORDER BY date_reservation DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $reservations = $stmt->execute();
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }
    
     static function recupererReservationsLivresDUnUtilisateur($utilisateur_id){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation INNER JOIN document ON reservation.document_id=document.id WHERE reservation.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'LIV-%\' ORDER BY date_reservation DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $reservations = $stmt->execute();
	$reservations = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservations;
    }

     static function recupererReservationDUnUtilisateurParDocumentId($utilisateur_id, $document_id){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation WHERE utilisateur_id=:utilisateur_id AND document_id=:document_id');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $stmt->bindValue(':document_id', $document_id, PDO::PARAM_INT);
        $reservation = $stmt->execute();
	$reservation = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservation;
    }
    
     static function recupererReservationParId($id){
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id FROM reservation WHERE id=:id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $reservation = $stmt->execute();
	$reservation = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
		   
	return $reservation;
    }
   
    
    static function enregistrerReservation($utilisateur_id, $document_id){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            INSERT INTO reservation (date_reservation, utilisateur_id, document_id)
                VALUES (NOW(), :utilisateur_id, :document_id)');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $stmt->bindValue(':document_id', $document_id, PDO::PARAM_INT);
        $res = $stmt->execute();
        if ($res){
            return $pdo->lastInsertId();
        }else {
            return -1;
        }
    }

    static function traiterReservation($id_reservation){
	$pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('UPDATE reservation SET traitee = 1 WHERE id = :id_reservation');
        $stmt->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);
        $res = $stmt->execute();
        if ($res){
            return $stmt->rowCount() ? true : false;
        }else{
            return -1;
        }
        
    }
    
    static function emprunterReservation($id_reservation){
        $pdo = DB::getConnection();

	$stmt = $pdo->prepare('SELECT reservation.id, reservation.date_reservation, reservation.utilisateur_id, reservation.document_id, reservation.traitee FROM reservation WHERE id=:id_reservation');
        $stmt->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);
        $reservation = $stmt->execute();
	$reservation = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reservation::class);
        
        $stmt = $pdo->prepare('
            INSERT INTO emprunt (date_emprunt, date_retour, utilisateur_id, document_id)
                VALUES (NOW(), NULL, :utilisateur_id, :document_id)');
        $stmt->bindValue(':utilisateur_id', $reservation[0]->getUtilisateur_id(), PDO::PARAM_INT);
        $stmt->bindValue(':document_id', $reservation[0]->getDocument_id(), PDO::PARAM_INT);
        $res = $stmt->execute();
        if ($res){
            return $pdo->lastInsertId();
        }else {
            return -1;
        }
    }
    
    static function supprimerReservation($reservation){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            DELETE FROM reservation
                WHERE id=:reservation');
        $stmt->bindValue(':reservation', $reservation, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    static function verifierSiReservationExiste($utilisateur_id, $document_id){
        
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare("SELECT count(*) FROM reservation WHERE utilisateur_id = :utilisateur_id AND document_id = :document_id");
        $stmt->bindValue(':utilisateur_id', $utilisateur_id);
        $stmt->bindValue(':document_id', $document_id);
        $stmt->execute();
	$res = $stmt->fetchColumn();
        return ($res>0);
    }

    static function verifierSiReservationEstTraitee($id_reservation){
        
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare("SELECT count(*) FROM reservation WHERE id = :id_reservation AND traitee=1");
        $stmt->bindValue(':id_reservation', $id_reservation);
        $stmt->execute();
	$res = $stmt->fetchColumn();
        return ($res>0);
    }    
    
        static function delete($id){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('DELETE FROM track WHERE id = :id');
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
        
    }
    
    /**
    *
    *@return last inserted id or -1 if any problem
    **/
    static function save(Track $track){
        $pdo = DB::getConnection();
        
        $stmt = $pdo->prepare('
            INSERT INTO track ( title, author, duration)
                VALUES (:title, :author, :duration)');
        $stmt->bindValue(':title', $track->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(':author', $track->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(':duration', $track->getDuration(), PDO::PARAM_INT);
        $res = $stmt->execute();
        if ($res){
            return $pdo->lastInsertId();
        }else {
            return -1;
        }
        
    }
    
    static function update($track){
              // connection BDD
	$pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('UPDATE track SET title = :title, author = :author, duration = :duration WHERE id = :id');
        
        $stmt->bindValue(':id', $track->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':title', $track->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(':author', $track->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(':duration', $track->getDuration(), PDO::PARAM_INT);
        $res = $stmt->execute();
        if ($res){
            return $stmt->rowCount() ? true : false;
        }else{
            return -1;
        }
        
    }
    
    
    
    static function  getTrackById($id){
       // connection BDD
	$pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT * FROM track WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Track::class);
	$track = $stmt->fetch();

       
	$stmt->closeCursor(); // on ferme le curseur des résultats
		   
	

	return $track;
        
        
    }
    
    
    static function  getTracks(){
       // connection BDD
	$pdo = DB::getConnection();
	
	$sql = "SELECT * FROM track;";
			
	$stmt = $pdo->query($sql);

        $tracks = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Track::class);
        //var_dump($result);
	
	$stmt->closeCursor(); // on ferme le curseur des résultats
		   
	return $tracks;
        
        
    }
    
    static function  getTracksByTitle($title){
       // connection BDD
	$pdo = DB::getConnection();
			
	$stmt = $pdo->prepare("SELECT * FROM track WHERE title like :title");
        $stmt->bindValue(':title', '%'.$title.'%');
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Track::class);
        //var_dump($result);
	
	$stmt->closeCursor(); // on ferme le curseur des résultats
		   
	return $tracks;
        
        
    }
}
