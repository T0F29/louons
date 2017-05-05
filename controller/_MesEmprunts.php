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

class MesEmprunts extends Controller{

    public function run() {
        
        $view = new \Mediatheque\View\View('MesEmpruntsView');

        $empruntsBds = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsBdsDUnUtilisateur($_SESSION['user_id']);
        $empruntsCds = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsCdsDUnUtilisateur($_SESSION['user_id']);
        $empruntsLivres = \Mediatheque\Model\Dao\ManagerEmprunts::recupererEmpruntsLivresDUnUtilisateur($_SESSION['user_id']);

        //render view
        $view->render(array("empruntsBds"=>$empruntsBds, "empruntsCds"=>$empruntsCds, "empruntsLivres"=>$empruntsLivres));
        
        
    }

}
