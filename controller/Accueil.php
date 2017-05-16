<?php

namespace Locations\Controller;

use Locations\View\View;


class Accueil extends Controller {
    
    public function lancer(){
        
        $vue = new View('VueAccueil');
        $vue->rendre(NULL);
        
    }

}
