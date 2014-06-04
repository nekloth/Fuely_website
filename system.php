<?php

	date_default_timezone_set("Europe/Paris");

	function date2string($date,$time) {

		$laDate=strtotime($date);		
		$jour=date("d",$laDate);
		$mois=date("m",$laDate);
		$annee=date("Y",$laDate);

		$lHeure=strtotime($time);		
		$heure=date("H",$lHeure);
		$minute=date("i",$lHeure);
		$seconde=date("s",$lHeure);
		
		
		return $annee .  $mois .  $jour . $heure . $minute . $seconde;
	}

	function string2date ($source) {
		$annee = substr($source,0,4);
		$mois = substr($source,4,2);
		$jour = substr($source,6,2);
		return $annee . "-" . $mois . "-" . $jour;
	}

	function string2time ($source) {
		$heure = substr($source,8,2);
		$minute = substr($source,10,2);
		$seconde = substr($source,12,2);
		return $heure . ":" . $minute . ":" . $seconde;
	}


	$authkey = "!q4h@zK@s;cOj*8#7wxE9lyS=jGfq+wGb_+8DSB#yTiGpJjj";

?>