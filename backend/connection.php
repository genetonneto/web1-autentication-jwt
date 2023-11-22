<?php 
$host = "localhost";
$port = 3306;
$username = "geneton";
$password = "N3tto34382201!";
$database = "web_project";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $createDatabase = "CREATE DATABASE IF NOT EXISTS $database";
    $pdo->exec($createDatabase);

    // Conectar ao banco de dados web_project
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $createTable = "CREATE TABLE IF NOT EXISTS user (
        use_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        use_name VARCHAR(45) NOT NULL,
        use_email VARCHAR(255) NOT NULL UNIQUE,
        use_password VARCHAR(80) NOT NULL 
    )";
    $pdo->exec($createTable);

    // echo "Esquema criado com sucesso";

} catch (PDOException $error) {
    die("Connection Failed: " . $error->getMessage());
}
?>
