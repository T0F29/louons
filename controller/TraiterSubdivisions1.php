<?php
    header("Content-type:text/xml;charset=utf-8");
?>
    <?xml version="1.0" encoding="UTF-8"?>
    <elements>
	if(isset($_POST["Pays"]))
	{
            $res = mysql_query('SELECT id, nom FROM subdivision1 WHERE pays_id="'.$_POST["Pays"].'" ORDER BY nom);
            while($row = mysql_fetch_assoc($res))
            {
		echo '<element>';
                echo "<option>".$row['nom1_subdiv1_'.LANG]."</option>";
                echo "<valeur>".$row['id_subdivision_1']."</valeur>";
                echo '</element>';
		}
	}
    </elements>