<?php

namespace Locations\Controller;

use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');

class Connexion extends Controller{

    public function lancer() {
        
        $vue = new View('VueConnexion');
        $vue->rendre(NULL); 
        
    }

}
