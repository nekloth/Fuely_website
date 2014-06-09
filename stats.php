<h1>Stats</h1>

<?php
	include_once 'vars.php';
	include_once 'system.php';
	include_once 'requetes.php';
	
	
	if ($db = new sqlite3($dbname)) {
		echo "On commence.<br/>";



		
		
		//Calcul du total des dépenses, par Année
		$results = @$db->query($REQ_depense_par_annee);
	

		
		?>
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
				
				$num_item = 0;
				$total_quantite = 0;
				$total_prix = 0;
				while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
					//var_dump($row);
					$num_item += 1;
					$total_quantite += $row['quantite_achetee'];
					$total_prix += $row['prix_total'];
					echo "<tr><td>" . $row['annee'] . "</td><td>" . afficheReel($row['prix_total']) . " €</td><td>" . afficheEntier($row['quantite_achetee']) . " litres</td></tr>";
					
				}
				
				?>
				
				</table>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr><td><strong>Prix moyen par plein</strong></td><td><?php echo afficheReel($total_prix/$num_item); ?> €</td></tr>
					<tr><td><strong>Quantité moyenne par plein</strong></td><td><?php echo afficheReel($total_quantite/$num_item); ?> litres</td></tr>
				</table>
			</div>
		</div>

	<?php	
	} else {
		echo "Erreur d'accès à la base de données.";
	}
	
	
?>