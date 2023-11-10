<?php
    
    session_start();
    
    // Se não estiver logado, redirecione para a página de login
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit;
    }   
    
    $nomeCliente = "Nome do Cliente"; // Substitue-se pelo nome do cliente logado 

    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "ecomerce";
    // Conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['finalizar'])) {
        $usuarioId = $_SESSION['usuario_id'];
    
        // Obtenha os produtos do carrinho
        $selectCartSql = "SELECT c.id_produto, c.quantidade, p.preco, p.nome
                          FROM compras c
                          JOIN produtos p ON c.id_produto = p.id
                          WHERE c.usuario_id = $usuarioId";
    
        $cartResult = $conn->query($selectCartSql);
    
        if ($cartResult->num_rows > 0) {
            // Inicialize variável para calcular o total do pedido
            $totalPedido = 0;
    
            while ($cartRow = $cartResult->fetch_assoc()) {
                $idProduto = $cartRow['id_produto'];
                $quantidade = $cartRow['quantidade'];
                $precoUnitario = $cartRow['preco'];
                $nomeProduto = $cartRow['nome'];
    
                // Calcular o subtotal do produto no pedido
                $subtotal = $quantidade * $precoUnitario;
                $totalPedido += $subtotal;
    
                // Inserir o produto no pedido
                $insertPedidoSql = "INSERT INTO pedidos (cliente_id, id_produto, quantidade, total, descricao)
                                   VALUES ($usuarioId, $idProduto, $quantidade, $subtotal, '$nomeProduto')";
    
                if ($conn->query($insertPedidoSql) === FALSE) {
                    echo "Erro ao inserir produto no pedido: " . $conn->error;
                    exit;
                }
            }
    
            // Limpar o carrinho
            $clearCartSql = "DELETE FROM compras WHERE usuario_id = $usuarioId";
    
            if ($conn->query($clearCartSql) === TRUE) {
                echo "Pedido finalizado com sucesso!";
            } else {
                echo "Erro ao limpar o carrinho: " . $conn->error;
            }
        } else {
            echo "Seu carrinho está vazio.";
        }
    }
    
    
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <!--<link rel="stylesheet" href="style/carrinho-style.css">-->
    <link rel="stylesheet" type="text/css" href="estilos/footer-style.css">
    <link rel="stylesheet" href="style/carrinho-style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom JavaScript / JQuery puxa as partes eparadas do html ex.: footer, main-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>        
    
    <!--link dos icones carinho e menu-->
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--Links CSS para o menu lateral-->
    <link rel="stylesheet" href="estilos/MenuLateralCss/style.css">
    <link rel="stylesheet" type="text/css" href="estilos/MenuLateralCss/footer-style.css">
    <!--Link das fontes dos icones-->    
    <link rel="stylesheet" type="text/css" href="estilos/MenuLateralCss/fonts-icones.css"> 
    
</head>
<body>
<div class="menu">   

    <div class="nomeCliente">
        <li>Olá,</li>
        <li id="ClienteNome"><?php echo $_SESSION['nome_cliente']; ?></li><br>
    </div><br><br>

    <div id="menuLinks">
        <li><a id="logout" href="logout.php"><b>Logout</b></a></li>
        <li><a id="home" href="produtos.php"><b>Home</b></a></li>
        <li><a id="suas-compras" href="cliente.php"></i>
            <span class="tooltiptext"><b>Suas Compras</b></span>
        </a></li><br> 
    </div><br><br><br><br><br><br><br><br>              
        
        <div class="container footer">           

            <h3 class="titleFooter"> Contato</h3><br>

            <p><i class="icon icon-mail"></i> genivanrs@gmail.com</p><br>

            <p><i class="icon icon-whatsapp"></i> 27 9 9784-3331</p><br><br><br><br>

            <div>            
                <p id="NomeEmpresa"> GE EXPRESS - 2023,<br> todos os direitos reservados.</p> 
                <p></p>           
            </div>    
        </div>
    </div>
    
    <section class="sectionSegundaria" id="sectionSegundaria">
        <div class="botoes-header">
            <div class="conteudo-carrinho">
                <div class="botoes-carrinho">
                    <a href='limpar_carrinho.php'><button class="botao-carrinho">Limpar Carrinho</button></a>  

                    <button id="btnEfetuarPagamento" class="botao-carrinho">Efetuar Pagamento via PIX</button>                    

                    <a href='produtos.php'><button class="botao-carrinho">Comprar Mais</button></a>
                </div>
            </div>            
        </div>
    </section>
        <div class="conteudo">        
            <div class="container">                
                <div class="produtos_carrinho">                    
                    <?php  
                                                  
                        // Recupere os produtos do carrinho do banco de dados
                        $usuarioId = $_SESSION['usuario_id'];
                        $sql = "SELECT c.id_produto, p.nome, p.preco, c.quantidade
                                FROM compras c
                                JOIN produtos p ON c.id_produto = p.id
                                WHERE c.usuario_id = $usuarioId";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $total = 0;
                                                      

                            while ($row = $result->fetch_assoc()) {
                                $subtotal = $row['preco'] * $row['quantidade'];
                                $total += $subtotal;        
                                
                                echo 'Produto: ' . $row['nome'] . '<br>';

                                echo 'Quantidade: ' . $row['quantidade'] . '<br>';

                                echo 'Preço Unitário: R$ ' . number_format($row['preco'], 2, ',', '.') . '<br>';

                                echo 'Subtotal: R$ ' . number_format($subtotal, 2, ',', '.') ;

                                echo "<a href='remover_produto.php?id_produto=" . $row['id_produto'] . "'><i style='margin-left: 5px' class='bx bxs-trash'></i></a><br><hr>";

                            }
                            echo "<div class='total'>
                                <h2>Total a Pagar: R$ " . number_format($total, 2, ',', '.') . "</h2>";
                            echo "</div>";
                            
                        } else {
                            echo 'Seu carrinho está vazio.<br>';
                        }

                ?>
                    
            </div>
        </div>
    </div>
    <!--Modal pagamento pix-->
    <div id="modalPix" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Pagamento via PIX</h2>
            <img src="img/QrCode.png" alt="QR Code PIX" id="qrCode">
            <div class="button-row">
                <form method="post">
                    <button type="submit" name="finalizar" class="botao-carrinho">Finalizar Pedido</button>
                </form>
                <a href='produtos.php'><button class="botao-carrinho">Comprar +</button></a>
            </div>
        </div>
    </div>

    <script src="js/pagamentos.js"></script>
    
</body>
</html>


