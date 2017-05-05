<?php

namespace Locations\Model\Entities;

class Message {
    
    private $id;
    private $auteur;
    private $destinataire;
    private $date_message;
    private $titre;
    private $contenu;
    private $statut;

    function __construct() {   
    }
    
    function getId() {
        return $this->id;
    }

    function getAuteur() {
        return $this->auteur;
    }

    function getDestinataire() {
        return $this->destinataire;
    }

    function getDate_message() {
        return $this->date_message;
    }

    function getTitre() {
        return $this->titre;
    }

    function getContenu() {
        return $this->contenu;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    function setDestinataire($destinataire) {
        $this->destinataire = $destinataire;
    }

    function setDate_message($date_message) {
        $this->date_message = $date_message;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }





    
    
}

