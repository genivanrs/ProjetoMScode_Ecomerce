<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="estilos/produtos-style.css">
    <link rel="stylesheet" type="text/css" href="estilos/footer-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom JavaScript / JQuery puxa as partes eparadas do html ex.: footer, main-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>        
    <link rel="stylesheet" href="style/carrinho-style.css">
    
    
</head>
<body>
<?php
// Inicie a sessão para acessar o nome do cliente
session_start();

// Se não estiver logado, redirecione para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nomeCliente = "Nome do Cliente"; // Substitua pelo nome do cliente logado 

include('config.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cliente_id = $_SESSION['usuario_id']; // Defina o cliente_id

// Inicia uma transação
$conn->begin_transaction();

$erro = false; // Variável para controlar erros

// Preparar a instrução SQL com espaços reservados
$sql = "INSERT INTO pedidos (cliente_id, id_produto, descricao, quantidade, preco, total) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Vincular os parâmetros e executar a instrução
    $stmt->bind_param("iisddd", $cliente_id, $idProduto, $descricao, $quantidade, $preco, $total);

    foreach ($_SESSION['dados'] as $produto) {
        $idProduto = $produto['id_produto'];

        // Verifique se a chave 'descricao' existe no array $produto
    $descricao = isset($produto['descricao']) ? $produto['descricao'] : ''; // Define como vazia se não existir

        $quantidade = $produto['quantidade'];
        $preco = $produto['preco'];
        $total = $produto['total'];

        // Executar a instrução preparada para inserir cada pedido
        if (!$stmt->execute()) {
            $erro = true;
            break; // Sair do loop em caso de erro
        }

        // Verifique se há estoque suficiente para o produto
        $selectEstoque = $conn->prepare("SELECT quantidade FROM produtos WHERE id=?");
        $selectEstoque->bind_param("i", $idProduto);
        $selectEstoque->execute();
        $resultEstoque = $selectEstoque->get_result();
        $produtoEstoque = $resultEstoque->fetch_assoc();
        $estoqueAtual = $produtoEstoque['quantidade'];

        if ($quantidade <= $estoqueAtual) {
            // Atualize o estoque no banco de dados
            $novoEstoque = $estoqueAtual - $quantidade;
            $updateEstoque = $conn->prepare("UPDATE produtos SET quantidade=? WHERE id=?");
            $updateEstoque->bind_param("ii", $novoEstoque, $idProduto);
            $updateEstoque->execute();
        } else {
            // Se não houver estoque suficiente, trate esse caso (por exemplo, exibindo uma mensagem de erro).
            echo "Erro: Estoque insuficiente para o produto ID $idProduto";
            $erro = true;
            break;
        }
    }

    // Verifique se houve algum erro durante a inserção
    if ($erro) {
        echo "Erro ao adicionar os pedidos: " . $stmt->error;
        $conn->rollback(); // Desfaz a transação em caso de erro
    } else {
        echo "Pedidos adicionados com sucesso!";
        $conn->commit(); // Confirma a transação se tudo ocorreu bem
    }
} else {
    echo "Erro na preparação da instrução SQL: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

</body>
</html>