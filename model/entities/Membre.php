<?php

namespace Locations\Model\Entities;

class Membre {
    
    protected $id;
    protected $pseudo;
    protected $mot_de_passe_hashe;
    protected $prenom;
    protected $nom;
    protected $adresse;
    protected $code_postal;
    protected $ville;
    protected $pays;
    protected $email;
    protected $telephone;
    protected $statut;
    
    public function __construct() {
    }
    
    function getId() {
        return $this->id;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getMot_de_passe_hashe() {
        return $this->mot_de_passe_hashe;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCode_postal() {
        return $this->code_postal;
    }

    function getVille() {
        return $this->ville;
    }

    function getPays() {
        return $this->pays;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getStatut() {
        return $this->statut;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setMot_de_passe_hashe($mot_de_passe_hashe) {
        $this->mot_de_passe_hashe = $mot_de_passe_hashe;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCode_postal($code_postal) {
        $this->code_postal = $code_postal;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setPays($pays) {
        $this->pays = $pays;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }





}
