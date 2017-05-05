<h1>Connexion</h1>        
<div class="form-container">
    <form method="post" action="index.php?action=TraiterConnexion">

        <?php
        if (!empty($donnees['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> '.$donnees['erreur'].'</div>';
        }
        ?>
        <div class="form-group">
            <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required />
        </div>

        <br>
        <div class="form-group">
            <button type="submit" name="btn" class="btn">
                <i class="glyphicon glyphicon-log-in"></i> Connexion
            </button>
        </div>
        <br>
        
    </form>
    <p>Pas encore de compte? <a href="index.php?action=Inscription">Inscription</a></p>
</div>
