<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Photo;

require_once(dirname(__FILE__).'/BDD.php');
require_once(dirname(__FILE__).'/../entities/Photo.php');

class DAOPhoto {
    
    public static function recupererTous() {
        
    }

    /**
     * Récupérer toutes les photos d'une location
     * @param int $id Identifiant de la location
     * @return array $listeToutesPhotos
     */
    public static function recupererTousDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
        
	$req = $pdo->prepare(
                "SELECT id, nom, position "
                . "FROM photo "
                . "WHERE location_id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();

        $listeToutesPhotos = array();
        foreach ($resultats as $donnee) {
            
            $photo = new Photo();
            $photo->setId($donnee->id);
            $photo->setNom($donnee->nom);
            $photo->setPosition($donnee->position);
            
            array_push($listeToutesPhotos, $photo);
        }
            
        return $listeToutesPhotos;

    }
    
    public static function recupererUnParSonId($param) {
        
    }
    
    /**
     * Récupérer la photo principale d'une location
     * @param int $id Identifiant de la location
     * @return array $photoPrincipale
     */
    public static function recupererPrincipaleDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
        
	$req = $pdo->prepare(
                "SELECT id, nom, position "
                . "FROM photo "
                . "WHERE location_id = :id "
                . "AND position=1");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        if (!$resultat) {
            return null;
        }
        else {
            $photoPrincipale = new Photo();
            $photoPrincipale->setId($resultat->id);
            $photoPrincipale->setNom($resultat->nom);
            $photoPrincipale->setPosition($resultat->position);

            return $photoPrincipale;
        }

    }
    
    public static function ajouterUn($param) {
        
    }

    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
