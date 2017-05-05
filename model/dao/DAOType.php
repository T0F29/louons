<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use Locations\Model\Entities\Type;

require_once(dirname(__FILE__).'/BDD.php');
require_once(dirname(__FILE__).'/../entities/Type.php');

class DAOType {
    
    /**
     * Récupérer tous les types
     * @return array $listeTousTypes
     */
    public static function recupererTous() {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->query(
                "SELECT id, nom "
                . "FROM type "
                . "ORDER BY id ASC");
	
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultats = $req->fetchAll();
        
        $listeTousTypes = array();
        foreach ($resultats as $donnee) {
            
            $type = new Type();
            $type->setId($donnee->id);
            $type->setNom($donnee->nom);
            
            array_push($listeTousTypes, $type);
        }
        
        return $listeTousTypes;

    }    
    
    /**
     * Récupérer un type de location par son identifiant
     * @param int $id Identifiant du type de location
     * @return Type $type
     */
    public static function recupererUnParSonId($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT id, nom "
                . "FROM type "
                . "WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Type::class);
        $type = $req->fetch();

	return $type;
    }
  
    public static function ajouterUn($param) {
        
    }

    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
