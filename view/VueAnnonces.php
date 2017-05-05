<div class="row">
    
    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
    </ul>

    <div class="page-header">
        <h1>Annonces proposées</h1>
    </div>

    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>

    <div class="col-xxs-12">
        <?php
        if (empty($donnees['infos']))
        {
        ?>  
            Il n'y a pour l'instant aucune annonce
        <?php
        }
        else
        {
            foreach ($donnees['infos'] as $info): ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xxs-6">
                            <?php if (isset($info['photoPrincipale'])): ?>
                            <img src="assets/img/documents/<?= $info['photoPrincipale']->getNom() ?>"  class="img-thumbnail" alt="<?= $info['photoPrincipale']->getNom() ?>" >
                            <?php endif; ?>
                        </div>
                        <div class="col-xxs-6">
                            <h2><?= $info['annonce']->getTitre() ?></h2>
                            <p>
                                <?= $info['annonce']->getLocation()->getSurface_habitable() ?> m<sup>2</sup> / <?= $info['annonce']->getLocation()->getNb_max_personnes() ?> personnes max.
                                <?php if (isset($info['moyenneNotes'])): ?>
                                <br>
                                <?= round($info['moyenneNotes'],1) ?> / 5 (<?= $info['nombreDEvaluation'] ?> avis)
                                <?php endif; ?>
                            </p>
                            <p>
                                Annonce <?= $info['annonce']->getId() ?><br>
                                A partir de <?= $info['tarifLePlusBas'] ?> € / sem.
                            </p>
                            <p>
                                <a href="index.php?action=Annonce&amp;id=<?= $info['annonce']->getId() ?>">Voir l'annonce complète</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        }
        ?>
    </div>

</div>