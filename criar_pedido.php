<?php
// Inicie a sessão 
session_start();

// Conecte-se ao banco de dados (substitua com suas credenciais)
include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém o ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém a descrição do pedido e a data do corpo da requisição
    $descricaoPedido = $_POST["descricao"];
    $dataPedido = $_POST["data"]; // A data é enviada a partir de produtos.php

    // SQL para inserir o pedido no banco de dados
    $sql = "INSERT INTO pedidos (cliente_id, descricao, data_compra) VALUES ($usuario_id, '$descricaoPedido', '$dataPedido')";

    if ($conn->query($sql) === TRUE) {
        echo "Pedido criado com sucesso.";
    } else {
        echo "Erro ao criar o pedido: " . $conn->error;
    }
} else {
    echo "Método de requisição inválido.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>

