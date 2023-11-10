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

// Consulta SQL para obter os pedidos do usuário
$sql = "SELECT * FROM pedidos WHERE cliente_id = $usuario_id ORDER BY data_compra DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="estilos/cliente-style.css">
</head>
<body>
    <h1>Lista de Pedidos</h1>
    <div class="header">
        <div class="header-left">
        <h3>Estas são as suas compras conosco, Sr(a)
        <?php 
            if (isset($_SESSION['nome_cliente'])) {
                echo $_SESSION['nome_cliente'] . "</p>";
            }
        ?>
        </h3>
        </div>
        <div class="button-group">
            <a href="logout.php" class="button-link">Logout</a>    
            <a href="produtos.php" class="button-link">Voltar a Comprar</a>
            
        </div>
    </div>
    <?php
    
    if ($result->num_rows > 0) {
    // Exibe a lista de pedidos
    while ($row = $result->fetch_assoc()) {
        echo "<p>Pedido ID: " . $row["id_pedido"] . "</p>";
        echo "<p>Descrição: " . $row["descricao"] . "</p>";
        // Exibe a data do pedido
        $dataPedido = date("d-m-Y H:i:s", strtotime($row["data_compra"]));
        echo "<p>Data do Pedido: " . $dataPedido . "</p>";

        //Exibi uma linha em cada pedido para separar os mesmos
        echo "<hr>";
    }
    } else {
        echo "Nenhum pedido encontrado.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>

