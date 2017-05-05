<h1>Nouveautés</h1>
<h2>Bds</h2>
<div class="diaporama">

<?php
    foreach ($data['nouveautesBds'] as $bd) {
        ?>
            <div class="vignette">
                <div class="image">
                    <img src="assets/img/documents/<?php echo $bd->getImage(); ?>" >
                </div>
                <div class="legende">
                  <h3><?php echo $bd->getTitre(); ?></h3>
                  <p>Une bd référencée <?php echo $bd->getCode_ref(); ?> ayant pour auteur <?php echo $bd->getAuteur(); ?> et pour illustrateur <?php echo $bd->getIllustrateur(); ?></p>
                  <?php
                    if (isset($_SESSION['user_id']))
                    {
                        if (!Mediatheque\Model\Dao\ManagerReservations::verifierSiReservationExiste($_SESSION['user_id'], $bd->getDocument_id()))
                        {
                            ?>
                            <p><a href="index.php?action=Reserver&amp;article=<?php echo $bd->getDocument_id(); ?>">Réserver cet article</a></p>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <p><a href="index.php?action=Reserver&amp;article=<?php echo $bd->getDocument_id(); ?>">Réserver cet article</a></p>
                        <?php
                    }
                  ?>
                </div>
            </div>
        <?php
    }
?>

</div>

<h2>Cds</h2>
<div class="diaporama">

<?php
    foreach ($data['nouveautesCds'] as $cd) {
        ?>
            <div class="vignette">
                <div class="image">
                    <img src="assets/img/documents/<?php echo $cd->getImage(); ?>" >
                </div>
                <div class="legende">
                  <h3><?php echo $cd->getTitre(); ?></h3>
                  <p>Un cd référencé <?php echo $cd->getCode_ref(); ?>, ayant pour auteur <?php echo $cd->getAuteur(); ?></p>
                  <?php
                    if (isset($_SESSION['user_id']))
                    {
                        if (!Mediatheque\Model\Dao\ManagerReservations::verifierSiReservationExiste($_SESSION['user_id'], $cd->getDocument_id()))
                        {
                            ?>
                            <p><a href="index.php?action=Reserver&amp;article=<?php echo $cd->getDocument_id(); ?>">Réserver cet article</a></p>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <p><a href="index.php?action=Reserver&amp;article=<?php echo $cd->getDocument_id(); ?>">Réserver cet article</a></p>
                        <?php
                    }
                  ?>
                </div>
            </div>
        <?php
    }
?>

</div>
     
<h2>Livres</h2>
<div class="diaporama">

<?php
    foreach ($data['nouveautesLivres'] as $livre) {
        ?>
            <div class="vignette">
                <div class="image">
                    <img src="assets/img/documents/<?php echo $livre->getImage(); ?>" >
                </div> 
                <div class="legende">
                  <h3><?php echo $livre->getTitre(); ?></h3>
                  <p>Un cd référencé <?php echo $livre->getCode_ref(); ?>, ayant pour auteur <?php echo $livre->getAuteur(); ?></p>
                  <?php
                    if (isset($_SESSION['user_id']))
                    {
                        if (!Mediatheque\Model\Dao\ManagerReservations::verifierSiReservationExiste($_SESSION['user_id'], $livre->getDocument_id()))
                        {
                            ?>
                            <p><a href="index.php?action=Reserver&amp;article=<?php echo $livre->getDocument_id(); ?>">Réserver cet article</a></p>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <p><a href="index.php?action=Reserver&amp;article=<?php echo $livre->getDocument_id(); ?>">Réserver cet article</a></p>
                        <?php
                    }
                  ?>
                </div>
             </div>
                <?php
    }
?>

</div>

        