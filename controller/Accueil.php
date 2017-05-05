<?php

namespace Locations\Controller;

use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');

class Accueil extends Controller {
    
    public function lancer(){
        
        $vue = new View('VueAccueil');
        $vue->rendre(NULL);
        
    }

}
