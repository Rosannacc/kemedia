<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kemedia";

//Connect To Database
function connect_to_database()
{
	
	//require_once 'config.php';
	global $servername;
	global $username;
	global $password;
	global $dbname;
	global $conn;
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

}



?>
