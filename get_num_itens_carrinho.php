<?php
// Inclua o arquivo de configuração do banco de dados
include('config.php');

// Inicie a sessão para acessar o nome do cliente
session_start();

// Restante do seu código para obter o número de itens no carrinho
$usuarioId = $_SESSION['usuario_id'];
$result = $conn->query("SELECT COUNT(*) as num_itens FROM compras WHERE usuario_id = $usuarioId");
$row = $result->fetch_assoc();
$numItensCarrinho = $row['num_itens'];

echo $numItensCarrinho;
?>
