<?php

namespace Locations\Controller;

use Locations\View\View;


class Connexion extends Controller{

    public function lancer() {
        
        $vue = new View('VueConnexion');
        $vue->rendre(NULL); 
        
    }

}
