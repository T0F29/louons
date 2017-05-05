<?php

namespace Locations\Model\Entities;

class Photo {
    
    private $id;
    private $nom;
    private $position;
    
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPosition() {
        return $this->position;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPosition($position) {
        $this->position = $position;
    }








    
    
}

