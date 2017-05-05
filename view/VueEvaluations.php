<h1>Evaluations disponibles</h1>
<div class="diaporama">

<?php
    foreach ($donnees['evaluations'] as $evaluation) {
        ?>
            <div class="vignette">
                <!--<div class="image">
                    <img src="assets/img/documents/<?php //echo $annonce->getImage(); ?>" >
                </div>-->
                <div class="legende">
                  <h3><?= $evaluation->getId(); ?></h3>
                  <p>Pays: <?= $evaluation->getLocation()->getProprietaire()->getPays()->getNom1();?><br>
                  <?php var_dump($evaluation); ?><br></p>
                </div>
            </div>
        <?php
    }
?>

</div>

