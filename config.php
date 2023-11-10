<?php
$servername = "localhost";
$username = "root";
$password = "102030@ABC";
$dbname = "ecomerce";

// Estabeleça a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
