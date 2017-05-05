<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mediatheque\Controller;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerEmprunts.php');
include(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
include(dirname(__FILE__).'/../model/dao/ManagerUtilisateurs.php');

class Emprunts extends Controller{

    public function run() {
        
        $view = new \Mediatheque\View\View('EmpruntsView');

        $empruntsBds = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsBds();
        $empruntsCds = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsCds();
        $empruntsLivres = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsLivres();

        //render view
        $view->render(array("empruntsBds"=>$empruntsBds, "empruntsCds"=>$empruntsCds, "empruntsLivres"=>$empruntsLivres));
        
        
    }

}
