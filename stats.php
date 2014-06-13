<h1>Stats</h1>

<?php
	include_once 'vars.php';
	include_once 'system.php';
	include_once 'requetes.php';
	
	
	if ($db = new sqlite3($dbname)) {

	?>

		<h3>Consommation annuelle moyenne</h3>
		<div class="row">
			<div class="col-md-6">
				<?php
				
				
				/*
				$d1 = new DateTime('$row['annee']."-".$row['mois']."-".$row['jour']." ".$row['heures'].":".$row['minutes'].":".$row['secondes']'); 
				$d2 = new DateTime('2009-06-10 20:30:00'); 
				$diff = $d1->diff($d2); 
				$nb_jours = $diff->d;
				echo $nb_jours . "<br/><br/><br/><br/>";
				*/
				
				
				$results = @$db->query($REQ_conso_moyenne_annuelle);
				$num_item = 0;
				$cumul_annuel = 0;
				$precedente_mesure = 0;
				$precedente_date = new DateTime();
				$date_consideree = new DateTime();
				$nombre_jours = 0;
				$annee_en_cours = 0;
				$position = 0;
				

				while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
					$position++;
					
					echo "..$position..(". $row['date'] .") : de $precedente_mesure à " . $row['quantite'] . "";
					
					if ($position == 1) {
						$num_item++;
						$annee_en_cours = $row['annee'];
						$precedente_mesure = $row['quantite'];
						$precedente_date   =  new DateTime($row['annee']."-".$row['mois']."-".$row['jour']." ".$row['heures'].":".$row['minutes'].":".$row['secondes']);

						echo " - INIT <br/>";
					} else {
					

						if ($precedente_mesure > $row['quantite']) { //On prendre en compte, il ne s'agit pas d'un plein
							$aCompter = $precedente_mesure - $row['quantite'];
							$num_item++;
							$cumul_annuel += $precedente_mesure - $row['quantite']; 
							$date_consideree   =  new DateTime($row['annee']."-".$row['mois']."-".$row['jour']." ".$row['heures'].":".$row['minutes'].":".$row['secondes']);
							$interval = $precedente_date->diff($date_consideree);
							$nombre_jours_temp = $interval->days;
							if ($interval->h>12) $nombre_jours_temp++;
							$nombre_jours += $nombre_jours_temp;
							echo " - Oui : ($aCompter litres et $nombre_jours_temp jours)<br/>";
							$precedente_mesure = $row['quantite'];
							$precedente_date   =  $date_consideree;

						} else {
							$precedente_mesure = $row['quantite'];
							$precedente_date   =  new DateTime($row['annee']."-".$row['mois']."-".$row['jour']." ".$row['heures'].":".$row['minutes'].":".$row['secondes']);
							echo " - Non <br/>";
						}
	
						if ($row['annee'] != $annee_en_cours) {
							echo "     -> Bilan annee $annee_en_cours : $num_item mesures <br/> Jours : $nombre_jours<br/>Quantite = $cumul_annuel<br/>Conso annuelle: ". round(($cumul_annuel/$nombre_jours)*365.25,2) ."<br/><br/>";
							$annee_en_cours = $row['annee'];
							$num_item = 0;
							$cumul_annuel = 0;
							$nombre_jours = 0;
							
						} 


					}

					
					//	var_dump($row);
					
					
				}
							echo "     -> Bilan annee $annee_en_cours : $num_item mesures <br/> Jours : $nombre_jours<br/>Quantite = $cumul_annuel<br/>Conso annuelle: ". round(($cumul_annuel/$nombre_jours)*365.25,2) ."<br/><br/>";
				?>
				
				
			</div>
			<div class="col-md-6">
				<?php 
				?>
			</div>
		
		
		</div>



		<h3>Dépenses annuelles</h3>
		<div class="row">

			<div class="col-md-6">
				<table class='table table-striped table-bordered table-hover table-condensed'>
					<tr>
						<th>Année</th>
						<th>Coût</th>
						<th>Quantité</th>
					</tr>
					<?php
					$results = @$db->query($REQ_depense_par_annee);
					$num_item = 0;
					$total_quantite = 0;
					$total_prix = 0;
					while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
						//var_dump($row);
						$num_item++;
						$total_quantite += $row['quantite_achetee'];
						$total_prix += $row['prix_total'];
						echo "<tr><td>" . $row['annee'] . "</td><td>" . afficheReel($row['prix_total']) . " €</td><td>" . afficheEntier($row['quantite_achetee']) . " litres</td></tr>";
					}
					?>				
				</table>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr><td><strong>Prix moyen par plein</strong></td><td><?php if ($num_item<>0) {echo afficheReel($total_prix/$num_item);}else{echo "N/A";} ?> €</td></tr>
					<tr><td><strong>Quantité moyenne par plein</strong></td><td><?php if ($num_item<>0) {echo afficheReel($total_quantite/$num_item);}else{echo "N/A";} ?> litres</td></tr>
				</table>
			</div>
		</div>

	<?php	
	} else {
		echo "Erreur d'accès à la base de données.";
	}
	
	
?>