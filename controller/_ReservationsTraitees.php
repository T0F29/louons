<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mediatheque\Controller;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerReservations.php');
include(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
include(dirname(__FILE__).'/../model/dao/ManagerUtilisateurs.php');

class ReservationsTraitees extends Controller{

    public function run() {
        
        $view = new \Mediatheque\View\View('ReservationsTraiteesView');

        $reservationsBdsTraitees = \Mediatheque\Model\Dao\ManagerReservations::recupererReservationsBdsTraitees();
        $reservationsCdsTraitees = \Mediatheque\Model\Dao\ManagerReservations::recupererReservationsCdsTraitees();
        $reservationsLivresTraitees = \Mediatheque\Model\Dao\ManagerReservations::recupererReservationsLivresTraitees();

        //render view

        $view->render(array("reservationsBdsTraitees"=>$reservationsBdsTraitees, "reservationsCdsTraitees"=>$reservationsCdsTraitees, "reservationsLivresTraitees"=>$reservationsLivresTraitees));
        
        
    }

}
