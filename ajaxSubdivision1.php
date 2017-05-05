<?php
	mysql_connect(HOST,USER,PASS) or die('Unable to connect to database');
	mysql_select_db(DBNAME) or die('Unable to select database');
	mysql_query('set names utf8');
	
	header("Content-type:text/xml;charset=utf-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo "<elements>";
	if(isset($_POST["Pays"]))
	{
  		$res = mysql_query('SELECT id_subdivision_1, nom1_subdiv1_'.LANG.' FROM subdivision_1 WHERE pays_id="'.$_POST["Pays"].'" ORDER BY nom1_subdiv1_'.LANG);
		while($row = mysql_fetch_assoc($res))
		{
			echo '<element>';
            echo "<option>".$row['nom1_subdiv1_'.LANG]."</option>";
            echo "<valeur>".$row['id_subdivision_1']."</valeur>";
            echo '</element>';
		}
	}
	echo "</elements>";
?>