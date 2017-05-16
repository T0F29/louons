<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Subdivision1;
use Locations\Model\Entities\Subdivision2;


class DAOSubdivision2 {
    
    /**
     * Récupérer toutes les subdivisions2 par ordre alphabétique
     * @return array $listeToutesSubdivisions2
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                'SELECT id, nom, subdivision1_id '
                . 'FROM subdivision2 '
                . 'ORDER BY nom ASC');
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesSubdivisions2 = array();
        foreach ($resultats as $donnee) {
            
            $subdivision1 = DAOSubdivision1::recupererUnParSonId($donnee->subdivision1_id);
            
            $subdivision2 = new Subdivision2();
            $subdivision2->setId($donnee->id);
            $subdivision2->setNom($donnee->nom);
            $subdivision2->setSubdivision1($subdivision1);
            
            array_push($listeToutesSubdivisions2, $subdivision2);
        }
		   
	return $listeToutesSubdivisions2;
        
    }
    
    /**
     * Récupérer toutes les subdivisions2 par ordre alphabétique en fonction d'une subdivision1
     * @param String $id_subdivision1 Identifiant de la subdivision1
     * @return array $listeToutesSubdivisions2
     */
    public static function recupererTousSelonSubdivision1($id_subdivision1) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                'SELECT id, nom, subdivision1_id '
                . 'FROM subdivision2 '
                . 'WHERE subdivision1_id = :id_subdivision1'
                . 'ORDER BY nom ASC');
        $req->bindValue(':id_subdivision1', $id_subdivision1);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesSubdivisions2 = array();
        foreach ($resultats as $donnee) {
            
            $subdivision1 = DAOSubdivision1::recupererUnParSonId($donnee->subdivision1_id);
            
            $subdivision2 = new Subdivision2();
            $subdivision2->setId($donnee->id);
            $subdivision2->setNom($donnee->nom);
            $subdivision2->setSubdivision1($subdivision1);
            
            array_push($listeToutesSubdivisions2, $subdivision2);
        }
		   
	return $listeToutesSubdivisions2;
        
    }
    
    /**
     * Récupérer une subdivision2 par son identifiant
     * @param String $id Identifiant de la subdivision2
     * @return Subdivision2 $subdivision2
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                'SELECT id, nom, subdivision1_id '
                . 'FROM subdivision2 '
                . 'WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        if (!$resultat) {
            return null;
        }
        else {
            $subdivision1 = DAOSubdivision1::recupererUnParSonId($resultat->subdivision1_id);

            $subdivision2 = new Subdivision2();
            $subdivision2->setId($resultat->id);
            $subdivision2->setNom($resultat->nom);
            $subdivision2->setSubdivision1($subdivision1);

            return $subdivision2;
        }
        
    }

    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
