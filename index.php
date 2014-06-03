<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fuel Level Tracking</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/application.css" rel="stylesheet">
    <link href="css/jquery.circliful.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="css/toastr.css" rel="stylesheet"/>
	
	<!--
		Liens intéressants ----
		http://ladensia.com/circliful/index.html
		http://getbootstrap.com/css/
		http://bootswatch.com/flatly/
	-->

  </head>

  <body class="container">

	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Fuel Level Tracking</a>
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<!--
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Accueil</a></li>
					<li><a href="#">Autres</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Déconnexion</a></li>
				</ul>
				-->
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	
	<div class="row">
	  <div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 id="titre_jauge"></h4></div>
			<div class="panel-body text-center">
				<span id="myStat" 
						data-dimension="250"
						data-info="litres" 
						data-fontsize="25" 
						data-fgcolor="#446e9b" 
						data-bgcolor="#cccccc"
						data-width="15"
						data-fill="#eee"
				/>
			</div>
		</div>
	  </div>
	  <div class="col-md-8">
			
				<div class="panel panel-primary">
					<div class="panel-heading"><h4>Nouveau relevé</h4></div>
					<div class="panel-body">
						<div class="row">
							<form class="form-inline" role="form">
								<div class="form-group col-md-4">
									<label class="control-label">Date de l'enregistrement</label>
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
										<input type="text" class="form-control datepicker" id="nouvelle_mesure_date" placeholder="Facultatif" >
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Quantité</label>
									<div class="input-group" id="groupe_quantite">
										<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
										<input type="text" class="form-control" id="nouvelle_mesure_quantite" placeholder="Requis">
										<span class="input-group-addon">litres</span>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label></label>
									<div class="input-group">
										<button class="btn btn-primary" id="poste_nouvelle_mesure">Enregistrer</button>
									</div>
								</div>
							</form>
						</div>
					</div> <!-- PANEL BODY -->
				</div> <!-- FIN PANEL RELEVE -->

				
				
				
				
				<div class="panel panel-primary">
					<div class="panel-heading"><h4>Nouveau plein</h4></div>
					<div class="panel-body">
						<div class="row">
							<form class="form-inline" role="form">
								<div class="form-group col-md-4">
									<label class="control-label">Date de l'enregistrement</label>
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
										<input type="text" class="form-control datepicker">
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Prix d'achat (pour 1000 l)</label>
									<div class="input-group" id="groupe_prix_achat">
										<input type="text" class="form-control trigger" id="prix_achat" placeholder="Requis" >
										<span class="input-group-addon"><span class="fa fa-euro"></span></span>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Coût total</label>
									<div class="input-group">
										<input type="text" class="form-control trigger" disabled id="cout_total">
										<span class="input-group-addon"><span class="fa fa-euro"></span></span>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Quantité avant le plein</label>
									<div class="input-group" id="groupe_quantite_avant">
										<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
										<input type="text" class="form-control trigger" id="quantite_avant" placeholder="Requis" >
										<span class="input-group-addon">litres</span>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Quantité achetée</label>
									<div class="input-group" id="groupe_quantite_achetee">
										<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
										<input type="text" class="form-control trigger" id="quantite_achetee" placeholder="Requis" >
										<span class="input-group-addon">litres</span>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label">Quantité finale</label>
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
										<input type="text" class="form-control trigger" disabled id="quantite_totale">
										<span class="input-group-addon">litres</span>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="control-label">Commentaires</label>
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
										<textarea class="form-control" id="commentaires" placeholder="Facultatif"></textarea>
									</div>
								</div>
								
								
								
								<div class="form-group col-md-4">
									<label></label>
									<div class="input-group">
										<button class="btn btn-primary" id="enregistrer-nouvea-plein">Enregistrer</button>
									</div>
								</div>
							</form>
						</div>
					</div> <!-- PANEL BODY -->
				</div> <!-- FIN PANEL RELEVE -->
	  </div> <!-- DEUXIEME COLONNE (8)-->
	</div> <!-- PREMIER NIVEAU/LIGNE -->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Evolution des niveaux</h4></div>
				<div class="panel-body">
					<div id="myfirstchart" style="height: 250px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Statistiques</h4></div>
			<div class="panel-body" >
				<button id="charger" class="btn btn-primary">Tester</button>
				<span id="sandbox"></span>
			</div>
			</div>
		</div>
	</div>
  
	



	<script src="js/jquery-2.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.circliful.min.js"></script>
	<script src="js/raphael-min.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/locales/bootstrap-datepicker.fr.js"></script>
    <script src="js/application.js"></script>
	<script src="js/toastr.js"></script>
	
	<script>

	
	function afficheLaJauge() {
		var request2 = $.ajax({
			type: "GET",
			url: "dernieresValeurs.php"
		});
			
		request2.done(function ( msg ) {
			var jeParse = JSON.parse( msg );
				
			$('#titre_jauge').html("Quantité au " + jeParse.ladate);
			$('#myStat').empty().removeData()
				.attr('data-percent', jeParse.pourcentage)
				.attr('data-text', jeParse.quantite)
				.circliful();
			});		
	}
	
	
	function donneesGraphe( ) {
		var sourceData = "";
		
		var graphData = $.ajax({
			type: "GET",
			url:"mesure.php",
			async: false
		});
			
		graphData.done( function ( msg ) {
			var data = JSON.parse(msg);
			for (var i = 0; i < data.nombre_de_mesures; i++) {
				if (i==0) sourceData = sourceData +  '['; //On est au début de la chaine
				sourceData = sourceData + '{"date":"' + string2date(data.valeurs[i].date) + '","value":' + data.valeurs[i].quantite + "}";
				if (i==(data.nombre_de_mesures-1)) {sourceData = sourceData + ']';} //On est bout de la chaine
				else {sourceData = sourceData + ',';} //On est entre deux valeurs
			}
		});
		
		return sourceData;
	}
	
	
	$(function(){
		auj = new Date();
		aujourdhui = "";
		if (auj.getDate()<10)  aujourdhui += "0"  + auj.getDate();  else aujourdhui=auj.getDate();
		if ((auj.getMonth()+1)<10) aujourdhui += "-0" + (auj.getMonth()+1); else aujourdhui+="-"+(auj.getMonth()+1);
		aujourdhui+="-"+auj.getFullYear();
		
		
		//$('#myStat').circliful();
		afficheLaJauge();
		
		
		$('.datepicker').val(aujourdhui).datepicker({
			format: "dd-mm-yyyy",
			language: "fr",
			multidate: false,
			keyboardNavigation: false,
			forceParse: false,
			autoclose: true,
			todayHighlight: true
		});	

		
		
		//On calcule des valeurs après quelques insertions
		$('.trigger').on('change',function(e){
			if (	(e.currentTarget.id == 'prix_achat' && $('#quantite_achetee').val() !="" )
					||
					(e.currentTarget.id == 'quantite_achetee' && $('#prix_achat').val() !="" )) 
			{
				total = $('#quantite_achetee').val() / 1000 * $('#prix_achat').val();
				$('#cout_total').val(total.toFixed(2));
			}
			
			if (	(e.currentTarget.id == 'quantite_avant' && $('#quantite_achetee').val() !="" )
					||
					(e.currentTarget.id == 'quantite_achetee' && $('#quantite_avant').val() !="" )) 
			{
				total2 = $('#quantite_avant').val()*1 + $('#quantite_achetee').val()*1 ;
				$('#quantite_totale').val(total2);
			}
			
			
		});



		//On instancie l'objet qui dessine le graphe
		theGraphe = graph = Morris.Line({
		  element: 'myfirstchart',
		  data: JSON.parse(donneesGraphe()),
		  xkey: 'date',
		  ykeys: ['value'],
		  labels: ['Quantité'],
		  postUnits: ' litres',
		  smooth: false
		});
				

		
		
		$('#enregistrer-nouvea-plein').on('click', function ( event ) {
			event.preventDefault();
			debug("[NOUVEAU PLEIN] On vient de cliquer sur le bouton enregistrer");
			var toutEstOk = true;
			
			if ( testeNombreReel($('#prix_achat').val()) ) {
				$('#groupe_prix_achat').removeClass('has-error');
			} else {
				$('#groupe_prix_achat').addClass('has-error');
				toutEstOk = false;
			}

			if ( testeNombreReel($('#quantite_avant').val()) ) {
				$('#groupe_quantite_avant').removeClass('has-error');
			} else {
				$('#groupe_quantite_avant').addClass('has-error');
				toutEstOk = false;
			}

			if ( testeNombreReel($('#quantite_achetee').val()) ) {
				$('#groupe_quantite_achetee').removeClass('has-error');
			} else {
				$('#groupe_quantite_achetee').addClass('has-error');
				toutEstOk = false;
			}
			
			

			if (!toutEstOk) {
				toastr.warning('Pense à donner les informations qui vont bien, sinon, je ne peux rien faire...','Tu n\'aurais pas oublié quelque chose ?');
			}
			else {
				debug("[NOUVEAU PLEIN] Tous les champs sont renseignés.");
			}
			
		});
		
		//On a cliqué sur "Enregistrer" une nouvelle mesure
		$('#poste_nouvelle_mesure').on('click',function( event ) {
			event.preventDefault();
			debug('[NOUVELLE MESURE] On demande un enregistrement');
			//On vérifie que tout est OK
			if ( $('#nouvelle_mesure_quantite').val()=="") { //La quantite n'est pas renseignée
				$('#groupe_quantite').addClass('has-error');
				//TOASTR
				toastr.warning('Pense à donner les informations qui vont bien, sinon, je ne peux rien faire...','Tu n\'aurais pas oublié quelque chose ?');
				debug('[NOUVELLE MESURE] Il manque des informations, je ne peux rien faire');
			} else {
				debug('[NOUVELLE MESURE] Allez, on va pouvoir enregistrer');
				$('#groupe_quantite').removeClass('has-error');
				
				
				var request = $.ajax({
					type: "POST",
					url: "mesure.php",
					data: { date: $('#nouvelle_mesure_date').val(), quantite: $('#nouvelle_mesure_quantite').val() }
				});
				
				request.done(function( msg ) {
					var retourJSON = JSON.parse( msg );
					if (retourJSON.resultat == "ERREUR") {
						toastr.error( 'Quelque chose ne s\'est pas bien passé. <br/><font size="-2">' + msg + '</font>','Mince, c\'est gênant...');			
					} else {
						// Tout s'est bien passé, on peut continuer.
						$('#nouvelle_mesure_quantite').val("");
						//On rafraichit le CERCLE et le GRAPHE
						afficheLaJauge();
						theGraphe.setData(JSON.parse(donneesGraphe()));
						toastr.success( 'Et bien voilà, c\'est enregistré ! Merci.', 'C\'est enregistré');			
					}
				});
				request.fail(function( msg ) {
					toastr.error( 'Quelque chose ne s\'est pas bien passé. Désolé (' + msg + ')','Mince, c\'est gênant...');			
				});
				
				
				
				
			}
			
		});
		
		//Ajax tests après click sur le bouton
		$('#charger').on('click',function () {
			// Pour mes tests
			
			
		});

		

	});
	</script>
  </body>
</html>