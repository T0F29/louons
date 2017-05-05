<?php

define('SQL_DSN',      'mysql:dbname=vacances;host=localhost;charset=utf8');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', 'admin');

define('UPLOAD_DIR', 'assets/img/documents/');



// pour php 5.6
// define('DMZ', array('','Accueil', 'Annonces', 'Departements', 'Locations', 'Enregistrement'));
const DMZ = array('', 'Accueil', 'Annonce', 'Annonces', 'Environnements', 'Locations', 'Evaluations', 'Connexion', 'Inscription', 'TraiterConnexion', 'TraiterInscription');
