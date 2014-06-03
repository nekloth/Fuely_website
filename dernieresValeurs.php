<?php

	include_once 'vars.php';
	include_once 'system.php';
	
	
	if ($db = new sqlite3($dbname)) {
		$query = @$db->query('SELECT date , quantite FROM mesures order by date desc');
		$i = 0;
		while ($row = $query->fetchArray()) {
			$derniereDate = string2date($row[0]);
			$derniereQuantite = $row[1];
			break;
		}
	}

	$dernierPourcentage = $derniereQuantite / 2000 * 100;
		
	echo 	'{ "ladate":"' 
			. $derniereDate 
			. '", "quantite":"' 
			. $derniereQuantite 
			. '", "pourcentage":"' 
			. $dernierPourcentage 
			. '" }';
?>