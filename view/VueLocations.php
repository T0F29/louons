<h1>Locations disponibles</h1>
<div class="diaporama">

<?php
    foreach ($donnees['locations'] as $location) {
        ?>
            <div class="vignette">
                <!--<div class="image">
                    <img src="assets/img/documents/<?php //echo $annonce->getImage(); ?>" >
                </div>-->
                <div class="legende">
                  <h3><?= $location->getID(); ?></h3>
                  <p>id: <?= $location->getID();?><br>
                      environnement_id: <?= $location->getEnvironnement()->getId();?><br>
                      environnement_nom: <?= $location->getEnvironnement()->getNom();?><br>
                  <?php //var_dump($location); ?><br></p>
                </div>
            </div>
        <?php
    }
?>

</div>

