<?php

namespace Locations\Model\Entities;

class Statut_membre {
    
    private $id;
    private $nom;
    
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }
    
    function getNom() {
        return $this->nom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }


    
    
}

