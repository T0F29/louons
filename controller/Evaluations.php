<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOEvaluation;
use Locations\View\View;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/DAOEvaluation.php');

class Evaluations extends Controller{

    public function lancer() {
        
        $vue = new View('VueEvaluations');
        $evaluations = DAOEvaluation::recupererTous();
        $vue->rendre(array("evaluations"=>$evaluations));
        
        
    }

}
