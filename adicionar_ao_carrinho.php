<?php
// Inicie a sessão (se ainda não estiver iniciada)
session_start();

// Verifique se o usuário está logado 
// Se não estiver logado, redirecione para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Conecte-se ao banco de dados (substitua com suas credenciais)
include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém o ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

$id_produto = $_POST['id_produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

// Verificar se o produto já está no carrinho do usuário
$sql_check = "SELECT * FROM compras WHERE usuario_id = $usuario_id AND id_produto = $id_produto";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // O produto já está no carrinho, pode ser incrementado
    $update_quantidade = $conn->prepare("UPDATE compras SET quantidade = quantidade + 1 WHERE usuario_id = ? AND id_produto = ?");
    $update_quantidade->bind_param("ii", $usuario_id, $id_produto);

    if ($update_quantidade->execute()) {
        echo "Quantidade do produto no carrinho incrementada com sucesso.";
    } else {
        echo "Erro ao incrementar a quantidade do produto no carrinho: " . $conn->error;
    }
} else {
    // Preparar a inserção
    $insert = $conn->prepare("INSERT INTO compras (usuario_id, id_produto, quantidade, descricao, preco) VALUES (?, ?, 1, ?, ?)");
    $insert->bind_param("iisd", $usuario_id, $id_produto, $descricao, $preco);

    if ($insert->execute()) {
        echo "Produto adicionado ao carrinho com sucesso.";
    } else {
        echo "Erro ao adicionar o produto ao carrinho: " . $conn->error;
    }
}

$conn->close();
?>

