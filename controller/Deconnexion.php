<?php

namespace Locations\Controller;


class Deconnexion extends Controller{

    public function lancer() {
        session_destroy();
        header("Location: index.php?action=Accueil");
    }

}
