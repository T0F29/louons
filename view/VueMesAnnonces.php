<div class="row">

    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
        <li><a href="index.php?action=EspaceMembre">Espace membre</a></li>
        <li class="active">Mes Annonces</li>
    </ul>

    <div class="page-header">
        <h1>Mes annonces</h1>
    </div>
    
    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>
    
    <div class="col-xxs-12">
        <h2>Nouvelle annonce</h2>
        <p><a href="index.php?action=AjouterUneAnnonce">Ajouter une annonce</a></p>
    </div>
    
    <div class="col-xxs-12">
        <h2>Annonces existantes</h2>
        <?php
        if (empty($donnees['infos']))
        {
        ?>  
            Vous n'avez pour l'instant aucune annonce
        <?php
        }
        else
        {
            foreach ($donnees['infos'] as $info): ?>
                <div class="col-md-10">
                    <div id="diaporama" class="row">
                        <div class="col-xxs-6">
                            <?php if (isset($info['photoPrincipale'])): ?>
                            <img src="assets/img/documents/<?= $info['photoPrincipale']->getNom(); ?>"  class="img-thumbnail" alt="<?= $info['photoPrincipale']->getNom(); ?>" >
                            <?php endif; ?>
                        </div>
                        <div class="col-xxs-6">
                            <h3><?= $info['annonce']->getTitre() ?></h3>
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
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="col-xxs-12">
                        <a href="index.php?action=MonAnnonce&amp;id=<?= $info['annonce']->getId() ?>">Consulter</a>
                    </div>
                    <div class="col-xxs-12">
                        <a href="index.php?action=ModifierUneAnnonce&amp;id=<?= $info['annonce']->getId() ?>">Modifier</a>
                    </div>
                    <div class="col-xxs-12">
                        <a href="index.php?action=SupprimerUneAnnonce&amp;id=<?= $info['annonce']->getId() ?>">Supprimer</a>
                    </div>
                </div>
            <?php endforeach;
        }
        ?>
    <div>

</div>



