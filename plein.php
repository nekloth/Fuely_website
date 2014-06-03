<?php

	include_once 'vars.php';
	include_once 'system.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		//On cherche à récupérer tous les pleins
		
		if ($db = new sqlite3($dbname)) {
           //$query = @$db->query('CREATE TABLE IF NOT EXISTS mesures ( date text , distance real , quantite real )');
		   //$query = @$db->query('SELECT * FROM mesures order by date');
		   

		   /*
		   $i = 0;
		   $values = "";
			while ($row = $query->fetchArray()) {
				if ($i!=0) $values = $values . ',' ;
				$values = $values . '{"position":' . $i ;
				$values = $values .  ',"date":' . $row['date'];
				if ($row['distance']!=NULL) $values = $values .  ',"distance":' . $row['distance'] ;
				$values = $values .  ',"quantite":' . $row['quantite'] ;
				$values = $values . '}';
				$i++;
			}

			echo '{"resultat":"OK", "nombre_de_mesures":' . $i . ', "valeurs": [';
			echo $values;
			echo "]}";		   
		} else {
			echo '{ resultat:"ERREUR", message: "Erreur d\'accès à la base de données" }';
		*/
		}

	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		/*
		if (!isset($_POST['date']) || !isset($_POST['quantite']) )
		{		
			echo '{ resultat:"ERREUR", message: "Paramètre manquant" }';
		} else { //Tous les paramètres sont là
			
				
			if ($db = new sqlite3($dbname)) {
			   $query = @$db->query('CREATE TABLE IF NOT EXISTS mesures ( date text , distance real , quantite real )');
			   
				/* On formatte la date comme il faut */
				if ( ($_POST['date'] == "") || (strlen($_POST['date']) != 14) ) {
					$quand  = date2string(date("Y-m-d"),date("H:m:s"));
				} else {
					$quand = $_POST['date'];
				}
				/* Notre date est bonne */
				
				/* On traite la distance mesurée */
				if (isset($_POST['distance'])) {
					$combien = $_POST['distance'];
					if ($combien=="") $combien = NULL;
				} else {
					$combien = NULL;
				}
				
				/* On traite la quantite */
				$litrage = round($_POST['quantite']);
				
				/* On construit la requête */
				$str = 'INSERT INTO mesures (date,distance,quantite) VALUES ("' . $quand . '",';
				if ($combien == NULL) 
					{ $str = $str . 'NULL' ;}
				else
					{ $str = $str . $combien ;}
				$str .= ',' . $litrage . ');';
				
				/* On exécute la requête */
				$query = @$db->query($str);
				echo '{"resultat":"OK", "message":"Valeur ajoutée"}';
			   
			} else {
				echo '{ resultat:"ERREUR", message: "Erreur d\'accès à la base de données" }';
			}
		
		}
		*/
	}
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'GET') {
		//Raté
		echo '{ resultat:"ERREUR", message: "Methode inconnue" }';
	}
	
	
?>