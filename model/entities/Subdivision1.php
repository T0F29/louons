<?php

namespace Locations\Model\Entities;

class Subdivision1 {
    
    private $id;
    private $nom;
    private $pays;

    function __construct() {
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPays() {
        return $this->pays;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPays($pays) {
        $this->pays = $pays;
    }




    
    
}

