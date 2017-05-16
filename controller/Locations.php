<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOLocation;
use Locations\View\View;


class Locations extends Controller{

    public function lancer() {
        
        $vue = new View('VueLocations');
        $locations = DAOLocation::recupererTous();
        $vue->rendre(array("locations"=>$locations));
        
    }

}
