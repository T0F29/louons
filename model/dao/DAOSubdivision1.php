<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Subdivision1;

require_once(dirname(__FILE__).'/BDD.php');
require_once(dirname(__FILE__).'/../entities/Subdivision1.php');

class DAOSubdivision1 {
    
    /**
     * Récupérer toutes les subdivisions1 par ordre alphabétique
     * @return array $listeToutesSubdivisions1
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                'SELECT id, nom, pays_id '
                . 'FROM subdivision1 '
                . 'ORDER BY nom ASC');
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesSubdivisions1 = array();
        foreach ($resultats as $donnee) {
            
            $pays = DAOPays::recupererUnParSonId($donnee->pays_id);
            
            $subdivision1 = new Subdivision1();
            $subdivision1->setId($donnee->id);
            $subdivision1->setNom($donnee->nom);
            $subdivision1->setPays($pays);
            
            array_push($listeToutesSubdivisions1, $subdivision1);
        }
		   
	return $listeToutesSubdivisions1;
        
    }
   
    /**
     * Récupérer toutes les subdivisions1 par ordre alphabétique en fonction d'un pays
     * @param String $id_pays Identifiant du pays
     * @return array $listeToutesSubdivisions1
     */
    public static function recupererTousSelonPays($id_pays) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                'SELECT id, nom, pays_id '
                . 'FROM subdivision1 '
                . 'WHERE pays_id = :id_pays'
                . 'ORDER BY nom ASC');
        $req->bindValue(':id_pays', $id_pays);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeToutesSubdivisions1 = array();
        foreach ($resultats as $donnee) {
            
            $pays = DAOPays::recupererUnParSonId();
            
            $subdivision1 = new Subdivision1();
            $subdivision1->setId($donnee->id);
            $subdivision1->setNom($donnee->nom);
            $subdivision1->setPays($pays);
            
            array_push($listeToutesSubdivisions1, $subdivision1);
        }
		   
	return $listeToutesSubdivisions1;
        
    }
    
    /**
     * Récupérer une subdivision1 par son identifiant
     * @param String $id Identifiant de la subdivision1
     * @return Subdivision1 $subdivision1
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                'SELECT id, nom, pays_id '
                . 'FROM subdivision1 '
                . 'WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $req->fetch();
        
        if (!$resultat) {
            return null;
        }
        else {
            $pays = DAOPays::recupererUnParSonId($resultat->pays_id);

            $subdivision1 = new Subdivision1();
            $subdivision1->setId($resultat->id);
            $subdivision1->setNom($resultat->nom);
            $subdivision1->setPays($pays);

            return $subdivision1;
        }
        
    }

    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
