<?php
session_start();

include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        // Captura o nome do cliente
        $nomeCliente = $row['nome'];
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['nome_cliente'] = $nomeCliente;
        header("Location: produtos.php"); // Redireciona para a página de produtos após o login bem-sucedido
        exit; // Certificar-se de encerrar o script após o redirecionamento
    } else {
        header("Location: index.php?erro=Senha incorreta");
        exit; // Encerre o script após o redirecionamento
    }
} else {
    header("Location: index.php?erro=Usuário não encontrado");
    exit; // Encerre o script após o redirecionamento
}

$conn->close();
?>

