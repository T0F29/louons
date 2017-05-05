<?php

namespace Locations\Model\Entities;

class Subdivision2 {
    
    private $id;
    private $nom;
    private $subdivision1;
    
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getSubdivision1() {
        return $this->subdivision1;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setSubdivision1($subdivision1) {
        $this->subdivision1 = $subdivision1;
    }







    
    
}

