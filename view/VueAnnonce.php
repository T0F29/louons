<div class="row">

    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
        <li><a href="#"><?= $donnees['annonce']->getLocation()->getPays()->getNom1(); ?></a></li>
        <?php if ($donnees['annonce']->getLocation()->getSubdivision1() != NULL): ?>
        <li><a href="#"><?= $donnees['annonce']->getLocation()->getSubdivision1()->getNom(); ?></a></li>
        <?php endif; ?>
        <?php if ($donnees['annonce']->getLocation()->getSubdivision2() != NULL): ?>
        <li><a href="#"><?= $donnees['annonce']->getLocation()->getSubdivision2()->getNom(); ?></a></li>
        <?php endif; ?>
        <li><a href="#"><?= $donnees['annonce']->getLocation()->getVille(); ?></a></li>
        <li class="active">Annonce <?= $donnees['annonce']->getId(); ?></li>
    </ul>

    <div class="page-header">
        <h1><?= $donnees['annonce']->getTitre() ?></h1>
    </div>

    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>
   
    <div class="col-md-8">

        <div class="row">
            
            <ul>
                <li>Aperçu</li>
            </ul>

            <div class="col-xxs-12">
                
                <?php if (!empty($donnees['photos'][0])): ?>

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    
                        <?php if (!empty($donnees['photos'][1])): ?>
                        
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <?php if (!empty($donnees['photos'][2])): ?>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][3])): ?>
                                    <li data-target="#myCarousel" data-slide-to="3"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][4])): ?>
                                    <li data-target="#myCarousel" data-slide-to="4"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][5])): ?>
                                    <li data-target="#myCarousel" data-slide-to="5"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][6])): ?>
                                    <li data-target="#myCarousel" data-slide-to="6"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][7])): ?>
                                    <li data-target="#myCarousel" data-slide-to="7"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][8])): ?>
                                    <li data-target="#myCarousel" data-slide-to="8"></li>
                                <?php endif; ?>
                                <?php if (!empty($donnees['photos'][9])): ?>
                                    <li data-target="#myCarousel" data-slide-to="9"></li>
                                <?php endif; ?>
                                    
                            </ol>
                            
                        <?php endif; ?>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            
                            <div class="item active">
                                <img src="assets/img/documents/<?= $donnees['photos'][0]->getNom() ?>" alt="<?= $donnees['photos'][0]->getNom() ?>">
                            </div>

                            <?php if (!empty($donnees['photos'][1])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][1]->getNom() ?>" alt="<?= $donnees['photos'][1]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][2])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][2]->getNom() ?>" alt="<?= $donnees['photos'][2]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][3])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][3]->getNom() ?>" alt="<?= $donnees['photos'][3]->getNom() ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($donnees['photos'][4])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][4]->getNom() ?>" alt="<?= $donnees['photos'][4]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][5])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][5]->getNom() ?>" alt="<?= $donnees['photos'][5]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][6])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][6]->getNom() ?>" alt="<?= $donnees['photos'][6]->getNom() ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($donnees['photos'][7])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][7]->getNom() ?>" alt="<?= $donnees['photos'][7]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][8])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][8]->getNom() ?>" alt="<?= $donnees['photos'][8]->getNom() ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($donnees['photos'][9])): ?>
                                <div class="item">
                                    <img src="assets/img/documents/<?= $donnees['photos'][9]->getNom() ?>" alt="<?= $donnees['photos'][9]->getNom() ?>">
                                </div>
                            <?php endif; ?>
                            
                        </div>

                        <?php if (!empty($donnees['photos'][1])): ?>
                        
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Précédent</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Suivant</span>
                            </a>
                        
                        <?php endif; ?>
                        
                    </div>
                    <!-- /.carousel -->
                
                <?php endif; ?>
                
                <?= $donnees['annonce']->getContenu(); ?><br>
                <?= $donnees['annonce']->getDate_annonce(); ?>
            </div>
            
        </div>

    </div>

    <div class="col-md-4">
        Propriétaire
    </div>
    
</div>

 


