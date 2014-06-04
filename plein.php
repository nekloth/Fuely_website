<?php

	include_once 'vars.php';
	include_once 'system.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		
		if ( !isset($_POST['date']) 
			 || !isset($_POST['quantite_avant']) 
			 || !isset($_POST['quantite_achetee'])
			 || !isset($_POST['prix_achat'])
		)			
		{		
			echo '{ resultat:"ERREUR", message: "Paramètre manquant" }';
		} else { //Tous les paramètres sont là
			
				
			if ($db = new sqlite3($dbname)) {
			   $query = @$db->query('CREATE TABLE IF NOT EXISTS pleins ( date text , quantite_achetee real , prix_achat real, prix_total real, commentaires text )');

			
				/* On formatte la date comme il faut */
				if ( ($_POST['date'] == "") || (strlen($_POST['date']) != 8) ) {
					$quand1 = date("Ymd") . '115959';
					$quand2 = date("Ymd") . '120000';
					$quand3 = date("Ymd") . '120001';
					
				} else {
					$quand1 = $_POST['date'] . '115959';
					$quand2 = $_POST['date'] . '120000';
					$quand3 = $_POST['date'] . '120001';
				}
				

				/* On prépare les variables PHP */
				$avant = $_POST['quantite_avant'];
				$achetee = $_POST['quantite_achetee'];
				$apres = $avant + $achetee;
				$prix = $_POST['prix_achat'];
				$total= ($achetee / 1000) * $prix;
				if (isset($_POST['commentaires'])) {
					$commentaires = $_POST['commentaires'];
				} else {
					$commentaires = "";
				}

				
				/* On construit la requête */
				
				$PretPourCommit = true;
				$str = 'BEGIN;';
				$query = @$db->query($str);

				$str = 'INSERT INTO mesures (date,quantite) VALUES ("' . mysql_real_escape_string($quand1) . '",' . mysql_real_escape_string($avant) . ');';
				$query1 = @$db->query($str);
				
				if (!$query1) {$PretPourCommit=false;}

				$str = 'INSERT INTO pleins (date, quantite_achetee, prix_achat, prix_total, commentaires) VALUES ("'.mysql_real_escape_string($quand2).'","'. mysql_real_escape_string($achetee) .'","'. mysql_real_escape_string($prix) .'","'. mysql_real_escape_string($total) .'","'. mysql_real_escape_string($commentaires) .'");';
				$query2 = @$db->query($str);
				if (!$query2) { $PretPourCommit = false; }

				
				$str = 'INSERT INTO mesures (date,quantite) VALUES ("' . mysql_real_escape_string($quand3) . '",' . mysql_real_escape_string($apres) . ');';
				$query3 = @$db->query($str);
				if (!$query3) { $PretPourCommit = false; }

				if ($PretPourCommit) {
					$str = 'COMMIT;';
					echo '{"resultat":"OK", "message":"Valeur ajoutée."}';
				} else {
					$str = 'ROLLBACK;';
					echo '{"resultat":"ERREUR", "message":"COMMIT impossible."}';
				}
				$query = @$db->query($str);

			   
			} else {
				echo '{ "resultat":"ERREUR", "message": "Erreur d\'accès à la base de données" }';
			}
		
		}

	}
	
	
	
	
	
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'GET') {
		//Raté
		echo '{ resultat:"ERREUR", message: "Methode inconnue" }';
	}
	
	
?>