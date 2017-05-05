<?php

namespace Locations\Model\Dao;

use \PDO as PDO;
use \Locations\Model\Entities\Se_loue;

require_once(dirname(__FILE__).'/BDD.php');

class DAOSe_loue {
    
    /**
     * Récupérer le tarif le plus bas d'une location dont on indique l'identifiant
     * @param int $id Identifiant de la location
     * @return Location $location
     */
    public static function recupererTarifLePlusBasDUneLocation($id) {
        
        $pdo = BDD::recupererConnexion();
			
	$req = $pdo->prepare(
                "SELECT MIN(prix) "
                . "FROM se_loue "
                . "WHERE location_id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        
        $tarifLePlusBas = $req->fetchColumn();

	return $tarifLePlusBas;
        
    }


    
    public static function recupererTous() {
        
    }
   
    public static function recupererUnParSonId($id) {
        
    }

    public static function ajouterUn($param) {
        
    }
    
    public static function modifierUn() {
        
    }

    public static function supprimerUn() {
        
    }

}
