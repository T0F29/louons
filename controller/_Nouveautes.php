<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mediatheque\Controller;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
include(dirname(__FILE__).'/../model/dao/ManagerReservations.php');

class Nouveautes extends Controller{

    public function run() {
        
        $view = new \Mediatheque\View\View('NouveautesView');


        $nouveautesBds = \Mediatheque\Model\Dao\ManagerDocuments::recupererNouveautesBds();
        $nouveautesCds = \Mediatheque\Model\Dao\ManagerDocuments::recupererNouveautesCds();
        $nouveautesLivres = \Mediatheque\Model\Dao\ManagerDocuments::recupererNouveautesLivres();

        //render view

        $view->render(array("nouveautesBds"=>$nouveautesBds, "nouveautesCds"=>$nouveautesCds, "nouveautesLivres"=>$nouveautesLivres));
        
        
    }

}
