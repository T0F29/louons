<?php

namespace Locations\Model\Entities;

class Location {
    
    private $id;
    private $environnement;
    private $type;
    private $code_postal;
    private $ville;
    private $subdivision2;
    private $subdivision1;
    private $pays;
    private $surface_habitable;
    private $surface_terrain;
    private $nb_max_personnes;
    private $proprietaire;

    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getEnvironnement() {
        return $this->environnement;
    }

    function getType() {
        return $this->type;
    }

    function getCode_postal() {
        return $this->code_postal;
    }

    function getVille() {
        return $this->ville;
    }

    function getSubdivision2() {
        return $this->subdivision2;
    }

    function getSubdivision1() {
        return $this->subdivision1;
    }

    function getPays() {
        return $this->pays;
    }

    function getSurface_habitable() {
        return $this->surface_habitable;
    }

    function getSurface_terrain() {
        return $this->surface_terrain;
    }

    function getNb_max_personnes() {
        return $this->nb_max_personnes;
    }

    function getProprietaire() {
        return $this->proprietaire;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEnvironnement($environnement) {
        $this->environnement = $environnement;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setCode_postal($code_postal) {
        $this->code_postal = $code_postal;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setSubdivision2($subdivision2) {
        $this->subdivision2 = $subdivision2;
    }

    function setSubdivision1($subdivision1) {
        $this->subdivision1 = $subdivision1;
    }

    function setPays($pays) {
        $this->pays = $pays;
    }

    function setSurface_habitable($surface_habitable) {
        $this->surface_habitable = $surface_habitable;
    }

    function setSurface_terrain($surface_terrain) {
        $this->surface_terrain = $surface_terrain;
    }

    function setNb_max_personnes($nb_max_personnes) {
        $this->nb_max_personnes = $nb_max_personnes;
    }

    function setProprietaire($proprietaire) {
        $this->proprietaire = $proprietaire;
    }





    
    
}

