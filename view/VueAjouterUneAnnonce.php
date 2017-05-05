<div class="row">

    <ul class="breadcrumb">
        <li><a href="index.php?action=Accueil">Accueil</a></li>
        <li><a href="index.php?action=EspaceMembre">Espace membre</a></li>
        <li><a href="index.php?action=MesAnnonces">Mes annonces</a></li>
        <li class="active">Ajouter une annonce</li>
    </ul>

    <div class="page-header">
        <h1>Ajouter une annonce</h1>
    </div>

    <?php if (!empty($donnees['erreur'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur!</strong> <?= $donnees['erreur'] ?>
        </div>
    <?php endif; ?>
   
    <div class="col-xxs-12">
        <form class="form-horizontal" method="post" action="index.php?action=TraiterAjouterUneAnnonce">
            <div class="form-group">
                <label class="control-label col-sm-3" for="titre">Titre: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="titre" name="titre" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getTitre(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="environnement">Environnement: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="environnement" name="environnement_id">
                        <option value="-1"> </option>
                        <?php foreach ($donnees['listeTousEnvironnements'] as $environnement): ?>
                            <option value="<?= $environnement->getId() ?>" <?php if (isset($donnees['annonce']) && ($donnees['annonce']->getLocation()->getEnvironnement() != null) && ($donnees['annonce']->getLocation()->getEnvironnement()->getId() === $environnement->getId())) echo 'selected'; ?>><?= $environnement->getNom(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="type">Type: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="type" name="type_id">
                        <option value="-1"> </option>
                        <?php foreach ($donnees['listeTousTypes'] as $type): ?>
                            <option value="<?= $type->getId() ?>" <?php if (isset($donnees['annonce']) && ($donnees['annonce']->getLocation()->getType() != null) && ($donnees['annonce']->getLocation()->getType()->getId() === $type->getId())) echo 'selected'; ?>><?= $type->getNom(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="cp">Code postal: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="cp" name="cp" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getLocation()->getCode_postal(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="ville">Ville: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ville" name="ville" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getLocation()->getVille(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pays">Pays: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="pays" name="pays_id" onchange="changerSubdivisions1()">
                        <option value="-1"> </option>
                        <?php foreach ($donnees['listeTousPays'] as $pays): ?>
                            <option value="<?= $pays->getId() ?>" <?php if (isset($donnees['annonce']) && (($donnees['annonce']->getLocation()->getPays()) != null) && ($donnees['annonce']->getLocation()->getPays()->getId() === $pays->getId())) echo 'selected'; ?>><?= $pays->getNom1(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group" id="ligne_subdivisions1">
                <label class="control-label col-sm-3" for="subdivision1">Région/Etat/Communauté: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="subdivision1" name="subdivision1_id" onchange="changerSubdivisions2()">
                        <option value="-1"> </option>
                        <?php foreach ($donnees['listeToutesSubdivisions1'] as $region): ?>
                            <option value="<?= $region->getId() ?>" <?php if (isset($donnees['annonce']) && (($donnees['annonce']->getLocation()->getsubdivision1()) != null) && ($donnees['annonce']->getLocation()->getsubdivision1()->getId() === $region->getId())) echo 'selected'; ?>><?= $region->getNom(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group" id="ligne_subdivisions2">
                <label class="control-label col-sm-3" for="subdivision2">Département: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="subdivision2" name="subdivision2_id">
                        <option value="-1"> </option>
                        <?php foreach ($donnees['listeToutesSubdivisions2'] as $departement): ?>
                            <option value="<?= $departement->getId() ?>" <?php if (isset($donnees['annonce']) && ($donnees['annonce']->getLocation()->getSubdivision2() != null) && ($donnees['annonce']->getLocation()->getSubdivision2()->getId() === $departement->getId())) echo 'selected'; ?>><?= $departement->getNom(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="surface_habitable">Surface habitable: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="surface_habitable" name="surface_habitable" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getLocation()->getSurface_habitable(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="surface_terrain">Surface du terrain: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="surface_terrain" name="surface_terrain" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getLocation()->getSurface_terrain(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="nb_max_personnes">Nombre maximum de personnes: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nb_max_personnes" name="nb_max_personnes" value="<?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getLocation()->getNb_max_personnes(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="contenu">Annonce: </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="contenu" name="contenu"><?php if (isset($donnees['annonce'])) echo $donnees['annonce']->getContenu(); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    
</div>

<script type="text/javascript">
<!--
    function getXhr()
    {
        var xhr = null; 
        if(window.XMLHttpRequest) // Firefox et autres
           xhr = new XMLHttpRequest(); 
        else if(window.ActiveXObject) { // Internet Explorer 
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        else { // XMLHttpRequest non supporté par le navigateur 
           alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
           xhr = false; 
        } 
        return xhr;
    }

    /**
    * Méthode qui sera appelée sur le click du bouton
    */

    function changerSubdivisions1()
    {
        var region = "<?= $subdivision1_id?>";
        document.getElementById('ligne_subdivisions1').style.display="none";
        document.getElementById('ligne_subdivisions2').style.display="none";
        //Si c'est AUCUN qui est sélectionné, il faut réinitialiser les 2 autres combos et quitter
        var sel = document.getElementById('pays');
        if (sel.options[sel.selectedIndex].value == -1) 
        {
            document.getElementById('subdivision1').options.length=0;
            document.getElementById('subdivision2').options.length=0;
            return;
        }

        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function()
        {
            // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                var rst = xhr.responseXML;
                var items=rst.getElementsByTagName('element');
                document.getElementById('subdivision1').options.length=0;
                //penser à réinitialiser aussi subdivision2
                document.getElementById('subdivision2').options.length=0;

                var myOption = new Option(" ","-1",true);
                document.getElementById('subdivision1').options[0]=myOption;

                for(var i=0;i<items.length;i++)
                {
                    var myOption = new Option(items[i].getElementsByTagName('option')[0].firstChild.nodeValue,items[i].getElementsByTagName('valeur')[0].firstChild.nodeValue,false,true)
                    document.getElementById('subdivision1').options[i+1]=myOption;
                    if (region == document.getElementById('subdivision1').options[i+1].value)
                    {
                        var bon = i+1;
                    }
                }
                document.getElementById('subdivision1').selectedIndex=bon;
                //document.getElementById('subdivision1').selectedIndex=0;
                //mise à jour de subdivision2 pour la 1ere subdivision1 affiché (sinon incohérence au niveau de l'affichage)
                changeSubdivisions2();
            }
        }

        // Ici on va voir comment faire du post
        xhr.open("POST","ajaxSubdivision1.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        // ne pas oublier de poster les arguments
        // ici, l'id du pays
        sel = document.getElementById('pays');
        pays = sel.options[sel.selectedIndex].value;
        xhr.send("Pays="+pays);			
    }

    function changerSubdivisions2()
    {
        var departement = "<?= $subdivision2?>";
        //si une seule subdivision1 ...	
        if (document.getElementById('subdivision1').options.length==1) 
        {
            //on vide la derniere combo
            document.getElementById('subdivision2').options.length==0; 
            //on quitte
            return;
        }

        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function()
        {
            // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                var rst = xhr.responseXML;
                var items=rst.getElementsByTagName('element');
                document.getElementById('subdivision2').options.length=0;

                var myOption = new Option(" ","-1",true);
                document.getElementById('subdivision2').options[0]=myOption;

                for(var i=0;i<items.length;i++)
                {
                    var myOption = new Option(items[i].getElementsByTagName('option')[0].firstChild.nodeValue,items[i].getElementsByTagName('valeur')[0].firstChild.nodeValue,false,true)
                    document.getElementById('subdivision2').options[i+1]=myOption;
                    if (departement == document.getElementById('subdivision2').options[i+1].value)
                    {
                        var bonn = i+1;
                    }
                }
                document.getElementById('subdivision2').selectedIndex=bonn;
                //document.getElementById('subdivision2').selectedIndex=0;
                cache();
            }
        }

        // Ici on va voir comment faire du post
        xhr.open("POST","ajaxSubdivision2.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        // ne pas oublier de poster les arguments
        // ici, l'id de la region et du pays

        sel2 = document.getElementById('pays');
        pays = sel2.options[sel2.selectedIndex].value;

        sel = document.getElementById('subdivision1');
        subdivision1 = sel.options[sel.selectedIndex].value;

        xhr.send("Subdivision1="+subdivision1 + "&Pays="+pays);		
    }
-->
</script>