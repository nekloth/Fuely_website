<?php

	$REQ_depense_par_annee = 'SELECT substr(date,0,5) AS annee, SUM(prix_total) as prix_total, SUM(quantite_achetee) as quantite_achetee FROM pleins GROUP BY annee ORDER BY annee desc;';

	$REQ_conso_moyenne_annuelle = 'SELECT date,substr(date,0,5) AS annee, substr(date,5,2) AS mois, substr(date,7,2) AS jour, substr(date,9,2) AS heures, substr(date,11,2) as minutes, substr(date,13,2) as secondes, quantite FROM mesures ORDER BY date ASC;';
	
?>