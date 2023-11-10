<?php
// Inicie a sessão 
session_start();

// Verifique se o usuário está logado 
// Se não estiver logado, redirecione para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Recupere os dados do carrinho da sessão
$carrinho = $_SESSION['carrinho'];

// Conecte-se ao banco de dados 
include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém o ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Inicia uma transação
$conn->begin_transaction();

$erro = false; // Variável para controlar erros

// Preparar a instrução SQL com um espaço reservado
$sql = "INSERT INTO pedidos (cliente_id, descricao) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Vincular os parâmetros e executar a instrução
    $stmt->bind_param("is", $usuario_id, $descricao);

    foreach ($carrinho as $produto) {
        $descricao = $produto['descricao'];

        // Executar a instrução preparada para inserir cada pedido
        if (!$stmt->execute()) {
            $erro = true;
            break; // Sai do loop em caso de erro
        }
    }

    // Fechar a instrução preparada
    $stmt->close();
} else {
    echo "Erro na preparação da instrução SQL: " . $conn->error;
}

// Se não houver erros, efetive a transação; caso contrário, reverta-a
if (!$erro) {
    $conn->commit();
    // Limpe o carrinho da sessão
    $_SESSION['carrinho'] = [];
    // Redirecione de volta para a página de produtos com um indicador de sucesso
    header("Location: produtos.php?compra_sucesso=true");
    exit;
} else {
    $conn->rollback();
    echo "Erro ao salvar uma ou mais compras.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
