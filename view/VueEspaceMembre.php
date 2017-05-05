<div class="row">

    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
        <li class="active">Espace membre</li>
    </ul>
    
    <div class="page-header">
        <h1>Espace membre</h1>
    </div>
    
    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>
    
    <div>
        <p>Bonjour <?= $_SESSION['utilisateur_connecte']['pseudo'] ?>.</p>
        <p>
            Vous avez actuellement <?= $donnees['nbAnnonces'] ?> annonce<?php if ($donnees['nbAnnonces']>1): ?>s<?php endif ?>  en ligne.<br>
            <?php if ($donnees['nbAnnonces'] > 1): ?>
                Pour les gérer et éventuellement en ajouter de nouvelles, veuillez cliquer sur "MesAnnonces" dans le menu principal.
            <?php endif; ?>
            <?php if ($donnees['nbAnnonces'] == 1): ?>
                Pour la gérer et éventuellement en ajouter de nouvelles, veuillez cliquer sur "MesAnnonces" dans le menu principal.
            <?php endif; ?>
            <?php if ($donnees['nbAnnonces'] < 1): ?>
                Si vous louez un bien immobilier et souhaitez mettre une annonce sur notre site, veuillez cliquer sur "MesAnnonces" dans le menu principal.
            <?php endif; ?>
            
            
        </p>
        
    </div>
    
</div>

