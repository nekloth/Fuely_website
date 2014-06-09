<?php

	$REQ_depense_par_annee = 'SELECT substr(date,0,5) AS annee, SUM(prix_total) as prix_total, SUM(quantite_achetee) as quantite_achetee FROM pleins GROUP BY annee ORDER BY annee desc;';
	
?>