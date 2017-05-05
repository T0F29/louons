<?php

namespace Locations\Controller;

interface IController {
    public function lancer();
    public function avoirErreur();
    public function recupererErreur();
    public function definirErreur($param);
}
