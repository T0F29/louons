<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Locations\Controller;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerReservations.php');
include(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
include(dirname(__FILE__).'/../model/dao/ManagerUtilisateurs.php');

class Reservations extends Controller{

    public function run() {
        
        $view = new \Mediatheque\View\View('ReservationsView');

        $reservationsBds = \Locations\Model\Dao\ManagerReservations::recupererReservationsBds();
        $reservationsCds = \Locations\Model\Dao\ManagerReservations::recupererReservationsCds();
        $reservationsLivres = \Locations\Model\Dao\ManagerReservations::recupererReservationsLivres();

        //render view
        $view->render(array("reservationsBds"=>$reservationsBds, "reservationsCds"=>$reservationsCds, "reservationsLivres"=>$reservationsLivres));
        
        
    }

}
