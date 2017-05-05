<?php

namespace Locations\View;

class View {
    
    private $template;
    
    function __construct($nomDeFichierDeVue){
        //if (file_exists(dirname(__FILE__).'/'.$viewFileName)) {
            $this->template = $nomDeFichierDeVue;
        //}
    }
    
    function rendre($donnees){
        
        require(dirname(__FILE__).'/'.$this->template.'.php');
    }
}
    

