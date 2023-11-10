<?php
// Inicie a sessão para acessar o ID do cliente
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Usuário não está logado.");
}

// Certifique-se de que a solicitação seja um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receba os dados do carrinho do cliente no formato JSON
    $data = file_get_contents('php://input');
    $carrinhoArray = json_decode($data, true);

    // Conecte-se ao banco de dados (substitua com suas credenciais)
    include('config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // ID do cliente logado
    $clienteId = $_SESSION['usuario_id'];

    // Converta o array do carrinho de volta para JSON
    $carrinhoJson = json_encode($carrinhoArray);

    // Atualize o registro na tabela
    $sql = "UPDATE carrinhos SET carrinho = '$carrinhoJson' WHERE cliente_id = $clienteId";
    $conn->query($sql);

    // Feche a conexão com o banco de dados
    $conn->close();
}
?>
