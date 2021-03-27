<?php
$esito = 0;
$lastID = $_POST['lastid'];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kemedia";

$conn = new mysqli($servername, $username, $password, $dbname);

$query = "SELECT MAX(id) FROM ordini";
$result = $conn->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);


if($row['MAX(id)']>$lastID){
     $esito = 1;
}else{
     $esito = 0;
}

echo $esito;

?>