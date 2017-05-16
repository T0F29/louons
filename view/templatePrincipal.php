<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <title>Locations de vacances</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/grille-avancee.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="container">
            <header>
                <div id="bandeauHeader" class="row">
                    <div class="col-xxs-3 col-md-2">
                        <img src="assets/img/logo.jpg" alt="locations de vacances" width="100%">
                    </div>
                    <div id="titreHeader" class="col-xxs-9 col-md-10">
                        <p>Locations de vacances</p>
                    </div>
                </div>
                <div class="row">
                    <nav class="navbar navbar-default" id="menu">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Etendre la navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Locations Vacances</a>
                            </div>
                            <div id="navbar" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li<?php if ($_SERVER['REQUEST_URI'] == "index.php?action=Annonces") echo 'class="active"'; ?>><?php if ($_SERVER['REQUEST_URI'] != "index.php?action=Annonces") echo '<a href="index.php?action=Annonces">Annonces</a>'; else echo 'Annonces'; ?></li>
                                    <li<?php if ($_SERVER['REQUEST_URI'] == "index.php?action=Recherche") echo 'class="active"'; ?>><?php if ($_SERVER['REQUEST_URI'] != "index.php?action=Recherche") echo '<a href="index.php?action=Recherche">Recherche</a>'; else echo 'Recherche'; ?></li>
                                    <?php if (isset($_SESSION['utilisateur_connecte'])): ?>
                                    <li>
                                        <a href="index.php?action=MesAnnonces">Mes annonces</a>  
                                    </li>
                                    <?php endif; ?>
                                    
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <?php if (isset($_SESSION['utilisateur_connecte'])): ?>
                                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['utilisateur_connecte']['pseudo']; ?> <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Informations personnelles</a></li>
                                                <li><a href="index.php?action=Deconnexion">Déconnexion</a></li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!isset($_SESSION['utilisateur_connecte'])): ?>
                                        <li>
                                            <a href="index.php?action=Connexion"><span class="glyphicon glyphicon-log-in"></span> Connexion</a>
                                        </li>
                                        <li>
                                            <a href="index.php?action=Inscription"><span class="glyphicon glyphicon-user"></span> Inscription</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container -->
                    </nav>
                </div>
            </header>
            <main>

                    <?php

                        echo $donnees['contenu']; 

                    ?>

            </main>
            <footer class="row">
                <div class="panel panel-body">
                    Copyright - CGU
                </div>
            </footer>      
        </div>
    </body>
    
</html>
    
    

