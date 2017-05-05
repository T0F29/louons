<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Locations\Controller;

use \Locations\Model\Dao\ManagerDocuments;
use \Locations\Model\Dao\ManagerReservations;
use \Locations\Model\Entities\Document;
use \Locations\Model\Entities\Reservation;

require_once(dirname(__FILE__).'/Controller.class.php');
require_once(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
require_once(dirname(__FILE__).'/../model/dao/ManagerReservations.php');

class AnnulerReservation extends Controller{  
    

    public function run() {

            $reservation = filter_input(INPUT_GET, 'reservation', FILTER_SANITIZE_NUMBER_INT);

            if ($reservation){

                ManagerReservations::supprimerReservation($reservation);
                if ($_SESSION['isadmin']) {
                    header("Location: index.php?action=Reservations",true,303);
                }
                else
                {
                    header("Location: index.php?action=MesReservations",true,303);
                }
            }

            else{
                $this->errors = 'L\'id de réservation est obligatoire';
            }
        

        

    }

}