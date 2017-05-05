<h1>Mes emprunts en cours</h1>
<h2>Bds</h2>
<div class="diaporama">
<?php
    foreach ($data['empruntsBds'] as $empruntBd) {
?>
        <div class="vignette">
            <?php
            $bd = \Mediatheque\Model\Dao\ManagerDocuments::recupererBdParId($empruntBd->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $bd->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $bd->getTitre(); ?></h3>
              <p>Une bd référencée <?php echo $bd->getCode_ref(); ?> ayant pour auteur <?php echo $bd->getAuteur(); ?> et pour illustrateur <?php echo $bd->getIllustrateur(); ?></p>
              <p>Article emprunté depuis le <?php echo $empruntBd->getDate_emprunt()->format('d/m/Y'); ?></p>
            </div>

        </div>
<?php
    }
?>
</div>
<h2>Cds</h2>
<div class="diaporama">
<?php
    foreach ($data['empruntsCds'] as $empruntCd) {
?>
        <div class="vignette">
            <?php
            $cd = \Mediatheque\Model\Dao\ManagerDocuments::recupererCdParId($empruntCd->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $cd->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $cd->getTitre(); ?></h3>
              <p>Un cd référencé <?php echo $cd->getCode_ref(); ?> ayant pour auteur <?php echo $cd->getAuteur(); ?></p>
              <p>Article emprunté depuis le <?php echo $empruntCd->getDate_emprunt()->format('d/m/Y'); ?></p>
            </div>

        </div>
<?php
    }
?>
</div>
<h2>Livres</h2>
<div class="diaporama">
<?php
    foreach ($data['empruntsLivres'] as $empruntLivre) {
?>
        <div class="vignette">
            <?php
            $livre = \Mediatheque\Model\Dao\ManagerDocuments::recupererLivreParId($empruntLivre->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $livre->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $livre->getTitre(); ?></h3>
              <p>Un cd référencé <?php echo $livre->getCode_ref(); ?> ayant pour auteur <?php echo $livre->getAuteur(); ?></p>
              <p>Article emprunté depuis le <?php echo $empruntLivre->getDate_emprunt()->format('d/m/Y'); ?></p>
            </div>

        </div>
<?php
    }
?>
</div>



