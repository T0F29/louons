<?php

namespace Locations\Model\Entities;

class Annonce {
    
    private $id;
    private $titre;
    private $contenu;
    private $date_annonce;
    private $location;
    
    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->titre;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getDate_annonce() {
        return $this->date_annonce;
    }

    function getLocation() {
        return $this->location;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setDate_annonce($date_annonce) {
        $this->date_annonce = $date_annonce;
    }

    function setLocation($location) {
        $this->location = $location;
    }






    
    
}

