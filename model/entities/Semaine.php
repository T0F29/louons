<?php

namespace Locations\Model\Entities;

class Semaine {
    
    private $id;
    private $date_debut;
    
    function __construct() {
    }

    function getId() {
        return $this->id;
    }

    function getDate_debut() {
        return $this->date_debut;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate_debut($date_debut) {
        $this->date_debut = $date_debut;
    }








    
    
}

