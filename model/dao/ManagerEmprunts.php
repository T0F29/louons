<?php

namespace Mediatheque\Model\Dao;

use \Mediatheque\Model\Entities\Emprunt as Emprunt;
use \PDO as PDO;

require_once(dirname(__FILE__).'/DB.php');
require_once(dirname(__FILE__).'/../entities/Emprunt.class.php');

class ManagerEmprunts {

     static function recupererEmpruntsBds() {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE document.code_ref LIKE \'BD-%\' ORDER BY date_emprunt DESC');
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }
    
     static function recupererEmpruntsCds() {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE document.code_ref LIKE \'CD-%\' ORDER BY date_emprunt DESC');
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }
    
     static function recupererEmpruntsLivres() {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->query('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE document.code_ref LIKE \'LIV-%\' ORDER BY date_emprunt DESC');
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }
    
     static function recupererEmpruntsBdsDUnUtilisateur($utilisateur_id) {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE emprunt.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'BD-%\' ORDER BY date_emprunt DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $emprunts = $stmt->execute();
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }
    
     static function recupererEmpruntsCdsDUnUtilisateur($utilisateur_id) {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE emprunt.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'CD-%\' ORDER BY date_emprunt DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $emprunts = $stmt->execute();
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }
    
     static function recupererEmpruntsLivresDUnUtilisateur($utilisateur_id) {
        $pdo = DB::getConnection();
	
	$stmt = $pdo->prepare('SELECT emprunt.id, emprunt.date_emprunt, emprunt.date_retour, emprunt.utilisateur_id, emprunt.document_id FROM emprunt INNER JOIN document ON emprunt.document_id=document.id WHERE emprunt.utilisateur_id=:utilisateur_id AND document.code_ref LIKE \'LIV-%\' ORDER BY date_emprunt DESC');
        $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $emprunts = $stmt->execute();
	$emprunts = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Emprunt::class);
		   
	return $emprunts;
    }

}