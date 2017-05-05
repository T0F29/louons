<?php

namespace Locations\Model\Entities;

class Reserve {
    
    private $id;
    private $membre;
    private $location;
    private $semaine;
    private $statut;
    
    function __construct() {
    }

    function getId() {
        return $this->id;
    }

    function getMembre() {
        return $this->membre;
    }

    function getLocation() {
        return $this->location;
    }

    function getSemaine() {
        return $this->semaine;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMembre($membre) {
        $this->membre = $membre;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setSemaine($semaine) {
        $this->semaine = $semaine;
    }






    
    
}

