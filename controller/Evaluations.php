<?php

namespace Locations\Controller;

use Locations\Model\Dao\DAOEvaluation;
use Locations\View\View;


class Evaluations extends Controller{

    public function lancer() {
        
        $vue = new View('VueEvaluations');
        $evaluations = DAOEvaluation::recupererTous();
        $vue->rendre(array("evaluations"=>$evaluations));
        
        
    }

}
