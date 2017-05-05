<?php

namespace Locations\Model\Entities;

class Evaluation {
    
    private $id;
    private $note;
    private $texte;
    private $date_evaluation;
    private $auteur;
    private $location;

    function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getNote() {
        return $this->note;
    }

    function getTexte() {
        return $this->texte;
    }

    function getDate_evaluation() {
        return $this->date_evaluation;
    }

    function getAuteur() {
        return $this->auteur;
    }

    function getLocation() {
        return $this->location;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function setTexte($texte) {
        $this->texte = $texte;
    }

    function setDate_evaluation($date_evaluation) {
        $this->date_evaluation = $date_evaluation;
    }

    function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    function setLocation($location) {
        $this->location = $location;
    }







    
    
}

