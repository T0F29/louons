<?php

namespace Locations\Model\Entities;

class Pays {
    
    private $id;
    private $determinant;
    private $nom1;
    private $nom2;
    private $nom3;
 
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getDeterminant() {
        return $this->determinant;
    }

    function getNom1() {
        return $this->nom1;
    }

    function getNom2() {
        return $this->nom2;
    }

    function getNom3() {
        return $this->nom3;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDeterminant($determinant) {
        $this->determinant = $determinant;
    }

    function setNom1($nom1) {
        $this->nom1 = $nom1;
    }

    function setNom2($nom2) {
        $this->nom2 = $nom2;
    }

    function setNom3($nom3) {
        $this->nom3 = $nom3;
    }








    
    
}

