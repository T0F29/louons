<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mediatheque\Controller;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerReservations.php');

class TraiterReservation extends Controller{  
    

    public function run() {
        
        $reservation = filter_input(INPUT_GET, 'reservation', FILTER_SANITIZE_NUMBER_INT);
        
        if ($reservation) {
            
                if (!\Mediatheque\Model\Dao\ManagerReservations::verifierSiReservationEstTraitee($reservation)) {

                    \Mediatheque\Model\Dao\ManagerReservations::traiterReservation($reservation);
                    header("Location: index.php?action=ReservationsTraitees",true,303);

                }else{
                    $this->errors = 'Cette réservation est déjà traitée';
                }
           
        }else{
            $this->errors = 'L\'id de la réservation est obligatoire';
        }
        
    }

}
