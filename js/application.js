/* ********************************************************* */
/* Mes variable JS
/* ********************************************************* */

var debugMode = true;

if (debugMode) console.debug (" /!\\ ATTENTION /!\\ Le mode DEBUG est activé. Cette console peut être 'spammée'. Penses à changer la valeur de debugMode ! :)");


function string2date( laDate ) {
	//20120224150000 -> 2012-02-24 15:00:00
	return String(laDate).substr(0,4) + '-' + String(laDate).substr(4,2) + '-' + String(laDate).substr(6,2) + ' ' + String(laDate).substr(8,2) + ':' + String(laDate).substr(10,2) + ":" + String(laDate).substr(12,2)
}

function debug ( message) {
	//Affiche un message dans la console, si on est bien en mode Debug
	if (debugMode) console.debug(message);
}


function testeNombreReel ( leNombre ) {
	if (leNombre == "") return false;
	
	try { 
		var a = parseFloat(leNombre);
		if ( isNaN(a) ) return false;
		return true;
	} catch (err) {
		return false;
	}
	
}