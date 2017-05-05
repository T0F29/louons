<h1>Inscription</h1>        
<div class="form-container">
    <form method="post" action="index.php?action=TraiterInscription">

        <?php
        if (!empty($donnees['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">
            <strong>Erreur: </strong> '.$donnees['erreur'].'</div>';
        }
        ?>
        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getPrenom(); ?>" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getNom(); ?>" required>
        </div>
        <div class="form-group">
            <label for="pseudo">Nom d'utilisateur:</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getPseudo(); ?>" required>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe:</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <div class="form-group">
            <label for="mdp_confirmation">Confirmez le mot de passe:</label>
            <input type="password" class="form-control" id="mdp_confirmation" name="mdp_confirmation" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <textarea class="form-control" id="adresse" name="adresse" required><?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getAdresse(); ?></textarea>
        </div>
        <div class="form-group">
            <label for="cp">Code postal:</label>
            <input type="text" class="form-control" id="cp" name="cp" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getCode_postal(); ?>" required>
        </div>
        <div class="form-group">
            <label for="ville">Ville:</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getVille(); ?>" required>
        </div>
        <div class="form-group">
            <label for="pays">Pays:</label>
            <select class="form-control" id="pays" name="pays_id">
            <?php
                foreach ($donnees['listeTousPays'] as $pays) {
            ?>
                    <option value="<?= $pays->getId() ?>" <?php if (isset($donnees['futur_membre']) && $donnees['futur_membre']->getPays()->getId() === $pays->getId()) echo 'selected'; ?>><?= $pays->getNom1(); ?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getEmail(); ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone:</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php if (isset($donnees['futur_membre'])) echo $donnees['futur_membre']->getTelephone(); ?>" required>
        </div>
        
        <br>
        <div class="form-group">
            <button type="submit" name="btn" class="btn">
                <i class="glyphicon glyphicon-user"></i> Inscription
            </button>
        </div>
        <br>
        
    </form>
    <p>Déjà inscrit? <a href="index.php?action=Connexion">Connectez-vous</a></p>
</div>
