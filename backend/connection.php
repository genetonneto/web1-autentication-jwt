<?php 

$host = "localhost";
$port = 3306;
$username = "geneton";
$password = "N3tto34382201!";
$database = "web_project";

	try {
		$pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
		// echo ("Connection Sucesses");
	} catch (PDOException $error) {
		die("Connection Failed: " . $error->getMessage());
	}

?>
