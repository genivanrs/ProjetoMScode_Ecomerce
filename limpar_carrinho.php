<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirecione para a página de login
    exit;
}

$usuarioId = $_SESSION['usuario_id'];

include('config.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Execute a consulta SQL para excluir os registros relacionados ao usuário logado
$sql = "DELETE FROM compras WHERE usuario_id = $usuarioId";

if ($conn->query($sql) === TRUE) {
    // A consulta foi executada com sucesso, você limpou o carrinho no banco de dados
    // Agora, você pode limpar o carrinho na variável de sessão
    $_SESSION['itens'] = array();
    
    // Redirecione o usuário de volta para a página de produtos ou qualquer outra página
    header("Location: produtos.php"); // Substitua "produtos.php" pela página desejada
    exit;
} else {
    echo "Erro ao limpar o carrinho no banco de dados: " . $conn->error;
}

// Feche a conexão com o banco de dados
$conn->close();
?>

