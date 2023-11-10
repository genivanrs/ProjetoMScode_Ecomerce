<?php
// Conectar ao banco de dados
include('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Iniciar a sessão para acessar os detalhes do pedido
session_start();

if (isset($_SESSION['dados'])) {
    foreach ($_SESSION['dados'] as $produto) {
        $id_produto = $produto['id_produto'];
        $quantidade_vendida = $produto['quantidade'];

        // Obter o estoque atual do produto
        $select = $conn->prepare("SELECT quantidade FROM produtos WHERE id = ?");
        $select->bind_param("i", $id_produto);
        $select->execute();
        $result = $select->get_result();
        $row = $result->fetch_assoc();
        $estoque_atual = $row['quantidade'];

        // Verificar se há estoque suficiente para a venda
        if ($estoque_atual >= $quantidade_vendida) {
            // Atualizar o estoque
            $novo_estoque = $estoque_atual - $quantidade_vendida;
            $update = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?");
            $update->bind_param("ii", $novo_estoque, $id_produto);
            $update->execute();
        } else {
            echo "Não há estoque suficiente para o produto com ID $id_produto.";
            // Você pode tomar medidas adicionais, como redirecionar de volta ao carrinho ou exibir uma mensagem de erro.
        }
    }

    // Inserir o registro na tabela de pedidos
    $cliente_id = $_SESSION['usuario_id'];
    $total_pedido = $_produto['total'];

    $insert_pedido = $conn->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (?, ?)");
    $insert_pedido->bind_param("id", $cliente_id, $total_pedido);
    $insert_pedido->execute();

    // Limpar o carrinho
    unset($_SESSION['itens']);
    unset($_SESSION['dados']);

    echo "Pedido finalizado com sucesso!";
} else {
    echo "Nenhum produto no carrinho.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

