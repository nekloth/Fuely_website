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
				
				$results = @$db->query($REQ_conso_moyenne_annuelle);
				$num_item = 0;
				$cumul_annuel = 0;
				$precedente_mesure = 0;
				$nombre_jours = 0;
				$annee_en_cours = 0;
				$position = 0;

				while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
					$position++;
					
					echo "Analyse de $position (". $row['date'] .") : $precedente_mesure (avant), " . $row['quantite'] . " (maintenant)";
					
					if ($position == 1) {
						$num_item++;
						$annee_en_cours = $row['annee'];
						$precedente_mesure = $row['quantite'];
						echo " - INIT <br/>";
					} else {
					

						if ($precedente_mesure > $row['quantite']) { //On prendre en compte, il ne s'agit pas d'un plein
							echo " - On prend en compte <br/>";
							$num_item++;
							$cumul_annuel += $precedente_mesure - $row['quantite']; 
							$precedente_mesure = $row['quantite'];
							$nombre_jours = 0;
						} else {
							$precedente_mesure = $row['quantite'];
							echo " - On NE prend PAS en compte <br/>";
						}
	
						if ($row['annee'] != $annee_en_cours) {
							echo "     -> Bilan annee $annee_en_cours : $num_item mesures, jours : $nombre_jours, quantite = $cumul_annuel<br/>";
							$annee_en_cours = $row['annee'];
							$num_item = 0;
							$cumul_annuel = 0;
							$nombre_jours = 0;
							
						} 


					}

					
					//	var_dump($row);
					
					
				}
				echo "     -> Bilan annee $annee_en_cours : $num_item mesures, jours : $nombre_jours, quantite = $cumul_annuel<br/>";
				?>
				
				
			</div>
			<div class="col-md-6">
				Titi
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