<div class="row">

    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
        <li><a href="index.php?action=EspaceMembre">Espace membre</a></li>
        <li><a href="index.php?action=MesAnnonces">Mes annonces</a></li>
        <li class="active">Supprimer une annonce</li>
    </ul>

    <div class="page-header">
        <h1>Supprimer une annonce</h1>
    </div>
   
    <div class="alert alert-danger" role="alert">

            <form method="post" action="index.php?action=TraiterSupprimerUneAnnonce">
                Voulez-vous vraiment supprimer définitivement l'annonce ci-dessous?
                <button type="submit" class="btn btn-danger pull-right">Supprimer</button> 
                <!--<button type="button" class="btn btn-secondary pull-right" onclick="location.href='index.php?action=MesAnnonces'">Annuler</button>-->
                <a class="btn btn-default pull-right" href="index.php?action=MesAnnonces" role="button">Annuler</a>
            </form>

    </div>
    
    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>
    
    <div class="col-xxs-12">
        <div id="row">
            <div class="col-md-6">
                <div id="diaporama" class="row">
                    <div class="col-xxs-6">
                        <?php if (isset($donnees['photoPrincipale'])): ?>
                        <img src="assets/img/documents/<?= $donnees['photoPrincipale']->getNom() ?>"  class="img-thumbnail" alt="<?= $donnees['photoPrincipale']->getNom() ?>" >
                        <?php endif; ?>
                    </div>
                    <div class="col-xxs-6">
                        <h2><?= $donnees['annonce']->getTitre() ?></h2>
                        <p>
                            <?= $donnees['annonce']->getLocation()->getSurface_habitable() ?> m<sup>2</sup> / <?= $donnees['annonce']->getLocation()->getNb_max_personnes() ?> personnes max.
                            <?php if (isset($donnees['moyenneNotes'])): ?>
                            <br>
                            <?= round($donnees['moyenneNotes'],1) ?> / 5 (<?= $donnees['nombreDEvaluation'] ?> avis)
                            <?php endif; ?>
                        </p>
                        <p>
                            Annonce <?= $donnees['annonce']->getId() ?><br>
                            A partir de <?= $donnees['tarifLePlusBas'] ?> € / sem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
