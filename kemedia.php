<html>	
	<head>
    
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Latest News</title>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>	
		
	<script>			
		
		function countdown(){
			
			setTimeout(function() {
			var ID = $('#yourtableid tr:last').attr('id');
			
			$.ajax({
				 type: "POST",
				 url: "controllo.php",
				 data: {
					 lastid: ID
				 },
				 cache: false,
				 success: function(data) {
					 if(data == 1){
						 
						 location.reload();
					 }			
					
				},			 
			});	
				
			
			}, 10000);
			conto = setTimeout("countdown()",10000);			
			
		}	
	
	</script>
	</head>
	<body>
	<?php 
	include("functionkemedia.php");
	
	$result = caricaArticoli();
	
	?>
	
		<div class="container bootstrap snippets bootdey">
			<section id="contact" class="gray-bg padding-top-bottom">
				<div class="container bootstrap snippets bootdey">
				<div align="center">
					<fieldset class="corpo">
					
						<script type="text/javascript">
							countdown();
						</script>
					</fieldset>
				</div>
					<div class="row">
						<div class="col-sm-3"></div>
						<form class="col-sm-6 mt-4" id="add-elemento" action="#">
							<div class="form-group">
								<label for="Nome">Nome</label>
								<input type="text" class="form-control" id="Nome" placeholder="Nome" name="nome" value=""> 
							</div>
							<div class="form-group">
								<label for="Cognome">Cognome</label>
								<input type="text" class="form-control" id="Cognome" placeholder="Cognome" name="cognome">
							</div>
							<div class="form-group">
								<label for="Data">Data e Ora</label>
								<input type="datetime" class="form-control" id="Data" placeholder="Data e Ora" name="data">
							</div>
							<div class="form-group">
								<label for="NumeroOrdine">Numero Ordine</label>
								<input type="text" class="form-control" id="NumeroOrdine" placeholder="Numero Ordine" name="ordine">
							  </div>							  
							  <input class="btn btn-primary mt-2" id="bottone" type="button" value="Invia i dati">
						</form>
						<div class="col-sm-3"></div>
					</div>	
				</div>	
			</section>
			<hr>
			<table class="table table-striped" id="yourtableid">
			  <thead>
				<tr>
				  <th>Data e Orario</th>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Numero ordine</th>
					<th></th>
				</tr>
			  </thead>
			  <tbody>
			  <?php while ($row = $result->fetch_assoc()) { 
				if($row["spedito"] == 0){
				?>
					<tr id="<?php echo $row['id'] ?>">
					<td><?php echo $row["dataOra"] ?></td>
					<td><?php echo $row["Nome"] ?></td>
					<td><?php echo $row["Cognome"] ?></td>
					<td><?php echo $row["NumeroOrdine"] ?></td>
					<td>
						<a class="btn btn-danger btn-sm icon-only white delete" href="" id="<?php echo $row['id'] ?>">
							<i class="fa fa-times "></i>
						</a>
						<a class="btn btn-primary btn-sm icon-only white spedito" href="" id="<?php echo $row['id'] ?>">
							<i class="fa fa-paper-plane-o"></i>
						</a>
						<a class="btn btn-warning btn-sm icon-only white modifica" href="" id="<?php echo $row['id'] ?>">
							<i class="fa fa-pencil-square-o"></i>
						</a>
					</td>
				</tr>
				
							
			<?php 	}
			  }
			
			?>
			  </tbody>
			</table>		
	</div> 
	</body>
	
	
	<script>	
	
	$("#bottone").click(function(){

		var dati = $("#add-elemento").serialize(); //recupera tutti i valori del form automaticamente

		//form invio dati post ajax

		//questo alert potete levarlo, serve solo per farvi capire come vengono passati i dati
		//alert(dati);

		//invio
		$.ajax({
			type: "POST",
			url: "input.php",
			data: dati,
			dataType: "html",
			success: function(msg){
				$("#risultato").html(msg);

			},
			error: function(){
				alert("Chiamata fallita, si prega di riprovare...");
			}

		});//ajax

	});//bottone click
		
	$('.delete').click(function(){

		var ID = $(this).attr("id");
		var confirmalert = confirm("Sei sicuro di eliminare?");
		if (confirmalert == true) {
			 $.ajax({
				 type: "POST",
				 url: "functionkemedia.php",
				 data: {
					 id: ID
				 },
				 cache: false,
				 success: function(data) {
					if(data == 1){
						alert('Odine eliminato');
						location.reload();	
					}
					else{
						alert('ID non valido');
					}
								
					
				},
				 
			});
		}
	});
	
	$('.spedito').click(function(){

		var ID = $(this).attr("id");
		
		 $.ajax({
			 type: "POST",
			 url: "functionkemedia.php",
			 data: {
				 idspedito: ID
			 },
			 cache: false,
			 success: function(data) {
				if(data == 1){
					alert('Odine spedito');
					location.reload();	
				}
				else{
					alert('ID non valido');
				}
							
				
			},
			 
		});
		
	});
	
	$('.modifica').click(function(){

		var ID = $(this).attr("id");
		var obj;
		 $.ajax({
			 type: "POST",
			 url: "functionkemedia.php",
			 data: {
				 idmodifca: ID
			 },
			 cache: false,
			 success: function(data) {
				obj = jQuery.parseJSON(data);
				//alert(obj.nmodifica);
				$('#Nome').val(obj.nmodifica);	
				$('#Cognome').val(obj.cmodifica);	
				$('#Data').val(obj.domodifica);				
				$('#NumeroOrdine').val(obj.nomodifica);	
				return false;
			},
			 
		});
		
	});
	
	
	
	
	</script>