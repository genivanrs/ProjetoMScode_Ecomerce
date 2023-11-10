<?php
    session_start();

    // Verifique se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php"); // Redirecione para a página de login
        exit;
    }
    
    // Verifique se o ID do produto a ser removido foi fornecido via GET
    if (isset($_GET['id_produto'])) {
        $produtoId = $_GET['id_produto'];
    
        include('config.php');
    
        // Conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Verifique a conexão
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }
    
        // Execute a consulta SQL para remover o produto do carrinho
        $usuarioId = $_SESSION['usuario_id'];
        $sql = "DELETE FROM compras WHERE usuario_id = $usuarioId AND id_produto = $produtoId";
    
        if ($conn->query($sql) === TRUE) {
            // A consulta foi executada com sucesso, o produto foi removido do carrinho
            // Redirecione o usuário de volta para a página do carrinho
            header("Location: carrinho.php");
            exit;
        } else {
            echo "Erro ao remover o produto do carrinho no banco de dados: " . $conn->error;
        }
    
        // Feche a conexão com o banco de dados
        $conn->close();
    } else {
        // ID do produto não foi fornecido via GET, redirecione para a página do carrinho
        header("Location: carrinho.php");
        exit;
    }
    
?>
