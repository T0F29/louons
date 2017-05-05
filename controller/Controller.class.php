<?php

namespace Locations\Controller;

include(dirname(__FILE__).'/IController.php');

abstract class Controller implements IController {
    
    protected $erreur="";
    protected $id_membre;
    protected $pseudo_membre;
    protected $isAdmin;
      
    public function avoirErreur(){
        return (!empty($this->erreur));
    }
    
    public function recupererErreur(){
        return $this->erreur;
    }
    
    public function definirErreur($erreur){
        $this->erreur = $erreur;
    }
    
     public function getId_membre(){
       return $this->id_membre;
    }
    
    public function setId_membre($id_membre){
        $this->id_membre = $id_membre;
    }
    
    function getPseudo_membre() {
        return $this->pseudo_membre;
    }

    function setPseudo_membre($pseudo_membre) {
        $this->pseudo_membre = $pseudo_membre;
    }
    
    function isAdmin() {
        return $this->isAdmin;
    }

    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    public abstract function lancer();

}
