<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use \Locations\Model\Entities\Environnement;


class DAOEnvironnement {
    
    /**
     * Récupérer tous les environnements
     * @return array $listeTousEnvironnements
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                "SELECT id, nom "
                . "FROM environnement "
                . "ORDER BY id ASC");
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeTousEnvironnements = array();
        foreach ($resultats as $donnee) {
            
            $environnement = new Environnement();
            $environnement->setId($donnee->id);
            $environnement->setNom($donnee->nom);
            
            array_push($listeTousEnvironnements, $environnement);
        }
        
        return $listeTousEnvironnements;

    }    
    
    /**
     * Récupérer un environnement par son identifiant
     * @param int $id Identifiant de l'environnement
     * @return Environnement $environnement
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT id, nom "
                . "FROM environnement "
                . "WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Environnement::class);
        $environnement = $req->fetch();

	return $environnement;
    }

    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
