<?php
if(isset($_POST['id'])){
	$data['id'] = $_POST['id'];		
	deleteOrdine($data);
	
}

if(isset($_POST['idspedito'])){
	$data['idspedito'] = $_POST['idspedito'];		
	spedito($data);
}


if(isset($_POST['idmodifca'])){
	$data['idmodifca'] = $_POST['idmodifca'];		
	modifica($data);
}
	
function caricaArticoli(){
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "kemedia";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$result = $conn->query("SELECT id,dataOra, Nome, Cognome, NumeroOrdine, spedito FROM ordini ORDER BY dataOra");		
	return $result;
}

function deleteOrdine($artID){
	$id = $artID['id'];
	
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "kemedia";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = "SELECT id FROM ordini WHERE id = ".$id;
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	if($row['id'] != 0){
	
		$query1 = "DELETE FROM ordini WHERE id = ".$id;
		$result1 = $conn->query($query1);
		
		echo 1;
		exit;	
	}else{
		echo 0;
		exit;
	}
}

function spedito($idspedito){
	$id = $idspedito['idspedito'];
	
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "kemedia";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = "SELECT spedito FROM ordini WHERE id = ".$id;
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if($row['spedito'] == 0){
		
		$query1 = "UPDATE ordini SET spedito = 1 WHERE id = ".$id;		
		
	}else{
		$query1 = "UPDATE ordini SET spedito = 0 WHERE id = ".$id;
		
	}
	$result1 = $conn->query($query1);
	echo 1;
	exit;
	
	
}

function modifica($idmodifca){
	$id = $idmodifca['idmodifca'];
	
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "kemedia";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = "SELECT * FROM ordini WHERE id = ".$id;
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	$data['nmodifica'] = $row['Nome'];
	$data['cmodifica'] = $row['Cognome'];
	$data['nomodifica'] = $row['NumeroOrdine'];
	$data['domodifica'] = $row['dataOra'];
	inviamodifica($data);
	echo json_encode($data);
	
	
	exit;
	
	
	
}
function inviamodifica($data){
	return $data;
}
?>