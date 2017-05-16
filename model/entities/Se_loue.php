<?php

namespace Locations\Model\Entities;

class Se_loue {
    
    private $id;
    private $location;
    private $periode;
    private $semaine;
    private $montant;
    
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getLocation() {
        return $this->location;
    }

    function getPeriode() {
        return $this->periode;
    }

    function getSemaine() {
        return $this->semaine;
    }

    function getMontant() {
        return $this->montant;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setPeriode($periode) {
        $this->periode = $periode;
    }

    function setSemaine($semaine) {
        $this->semaine = $semaine;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }










    
    
}

