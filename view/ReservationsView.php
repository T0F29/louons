<h1>Réservations des membres</h1>
<h2>Bds</h2>
<div class="diaporama">
<?php
    foreach ($data['reservationsBds'] as $reservationBd) {
?>
        <div class="vignette">
            <?php
            $bd = \Mediatheque\Model\Dao\ManagerDocuments::recupererBdParId($reservationBd->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $bd->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $bd->getTitre(); ?></h3>
              <p>Une bd référencée <?php echo $bd->getCode_ref(); ?> ayant pour auteur <?php echo $bd->getAuteur(); ?> et pour illustrateur <?php echo $bd->getIllustrateur(); ?></p>
              <p><a href="index.php?action=AnnulerReservation&amp;reservation=<?php echo $reservationBd->getId(); ?>">Annuler cette réservation</a></p>
              <p><a href="index.php?action=TraiterReservation&amp;reservation=<?php echo $reservationBd->getId(); ?>">Traiter cette réservation</a> après avoir mis de côté cet article pour le membre numéro 
            <?php
            $utilisateur = \Mediatheque\Model\Dao\ManagerUtilisateurs::recupererUtilisateurDUneReservation($reservationBd->getId());
            echo $utilisateur[0]->getId().' ('.$utilisateur[0]->getPrenom().' '.$utilisateur[0]->getNom().')'
            ?>
              </p>
            </div>

        </div>
<?php
    }
?>
</div>
<h2>Cds</h2>
<div class="diaporama">
<?php
    foreach ($data['reservationsCds'] as $reservationCd) {
?>
        <div class="vignette">
            <?php
            $cd = \Mediatheque\Model\Dao\ManagerDocuments::recupererCdParId($reservationCd->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $cd->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $cd->getTitre(); ?></h3>
              <p>Un cd référencé <?php echo $cd->getCode_ref(); ?> ayant pour auteur <?php echo $cd->getAuteur(); ?></p>
              <p><a href="index.php?action=AnnulerReservation&amp;reservation=<?php echo $reservationCd->getId(); ?>">Annuler cette réservation</a></p>
             <p><a href="index.php?action=TraiterReservation&amp;reservation=<?php echo $reservationCd->getId(); ?>">Traiter cette réservation</a> après avoir mis de côté cet article pour le membre numéro 
            <?php
            $utilisateur = \Mediatheque\Model\Dao\ManagerUtilisateurs::recupererUtilisateurDUneReservation($reservationCd->getId());
            echo $utilisateur[0]->getId().' ('.$utilisateur[0]->getPrenom().' '.$utilisateur[0]->getNom().')'
            ?>
              </p>
            </div>

        </div>
<?php
    }
?>
</div>
<h2>Livres</h2>
<div class="diaporama">
<?php
    foreach ($data['reservationsLivres'] as $reservationLivre) {
?>
        <div class="vignette">
            <?php
            $livre = \Mediatheque\Model\Dao\ManagerDocuments::recupererLivreParId($reservationLivre->getDocument_id());
            ?>
            <div class="image">
                <img src="assets/img/documents/<?php echo $livre->getImage(); ?>">
            </div>
            <div class="legende">
              <h3><?php echo $livre->getTitre(); ?></h3>
              <p>Un cd référencé <?php echo $livre->getCode_ref(); ?> ayant pour auteur <?php echo $livre->getAuteur(); ?></p>
              <p><a href="index.php?action=AnnulerReservation&amp;reservation=<?php echo $reservationLivre->getId(); ?>">Annuler cette réservation</a></p>
             <p><a href="index.php?action=TraiterReservation&amp;reservation=<?php echo $reservationLivre->getId(); ?>">Traiter cette réservation</a> après avoir mis de côté cet article pour le membre numéro 
            <?php
            $utilisateur = \Mediatheque\Model\Dao\ManagerUtilisateurs::recupererUtilisateurDUneReservation($reservationLivre->getId());
            echo $utilisateur[0]->getId().' ('.$utilisateur[0]->getPrenom().' '.$utilisateur[0]->getNom().')'
            ?>
              </p>
            </div>

        </div>
<?php
    }
?>
</div>



