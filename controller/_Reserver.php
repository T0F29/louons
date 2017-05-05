<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mediatheque\Controller;

use \Mediatheque\Model\Dao\ManagerDocuments;
use \Mediatheque\Model\Dao\ManagerReservations;
use \Mediatheque\Model\Entities\Document;
use \Mediatheque\Model\Entities\Reservation;

include(dirname(__FILE__).'/Controller.class.php');
include(dirname(__FILE__).'/../model/dao/ManagerDocuments.php');
include(dirname(__FILE__).'/../model/dao/ManagerReservations.php');

class Reserver extends Controller{  
    

    public function run() {
        if (isset($_SESSION['user_id']))
        {
            $article = filter_input(INPUT_GET, 'article', FILTER_SANITIZE_NUMBER_INT);

            if ($article){

                $document = ManagerDocuments::recupererDocumentParId($article);
                $reservation = ManagerReservations::enregistrerReservation($_SESSION['user_id'], $document->getId());
                header("Location: index.php?action=MesReservations",true,303);
                }

            else{
                $this->errors = 'L\'id de l\'article est obligatoire';
            }
        }
        else
        {
            header("Location: index.php?action=Enregistrement",true,303);
        }
        

    }

}
