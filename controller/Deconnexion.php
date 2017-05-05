<?php

namespace Locations\Controller;

include(dirname(__FILE__).'/Controller.class.php');

class Deconnexion extends Controller{

    public function lancer() {
        session_destroy();
        header("Location: index.php?action=Accueil");
    }

}
