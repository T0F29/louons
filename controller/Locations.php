<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOLocation;
use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/DAOLocation.php');

class Locations extends Controller{

    public function lancer() {
        
        $vue = new View('VueLocations');
        $locations = DAOLocation::recupererTous();
        $vue->rendre(array("locations"=>$locations));
        
    }

}
