<?php
require_once 'db.php';

connect_to_database();


$data = urldecode($_POST['data']);
$nome = urldecode($_POST['nome']);
$cognome = urldecode($_POST['cognome']);
$ordine = urldecode($_POST['ordine']);

$sql = "INSERT INTO ordini (dataOra, Nome, Cognome, NumeroOrdine) VALUES ('$data', '$nome', '$cognome', '$ordine')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql = "SELECT * FROM ordine ORDER BY data ASC";
if ($conn->query($sql) === TRUE) {
	$news = $conn->query($sql);	
	echo $news;
}


$conn->close();
?>
