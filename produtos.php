<?php 
        
    session_start();

    // Se não estiver logado, redirecione para a página de login
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit;
    }  
    
    $nomeCliente = "Nome do Cliente"; // Substitue-se pelo nome do cliente logado 
    $conexao = new mysqli("localhost", "root", "102030@ABC", "ecomerce");
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    $consulta = "SELECT id, nome, descricao, preco, quantidade FROM produtos";
    $resultado = $conexao->query($consulta); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    <link rel="stylesheet" href="estilos/produtos-style.css">
    <link rel="stylesheet" href="style/style.css">    
    <link rel="stylesheet" type="text/css" href="estilos/footer-style.css">

    <!--Link das fontes dos icones-->    
    <link rel="stylesheet" type="text/css" href="estilos/fonts-icones.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom JavaScript / JQuery puxa as partes eparadas do html ex.: footer, main-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>     
    <!--link dos icones carinho e menu-->
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--Carroussel-->    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
 
</head>
<body>    
    <div class="mensagem-erro" id="erro-mensagem"></div>   
       
    <header>        
        <a href="#" class="logo"><img src="img/logo.png" alt="Logo da ELCTRO WORLD" width="10%" >GE EXPRESS</a>

        <ul class="navegação"> 
            <li class="nome-cliente-li">Olá,</li>
            <li><?php echo $_SESSION['nome_cliente']; ?></li>
            <li><a id="logout" href="logout.php"><b>Logout</b></a></li>            
            <li><a href="editar_perfil.php"><b>Perfil</b></a></li>
        </ul>  
        
        <div class="header-icons">
            <div class="tooltip">
                <a href="carrinho.php">
                    <i class='bx bx-cart'></i>
                    <span class="tooltiptext"></span>
                </a>
            </div>
            <span id="numItensCarrinho" class="num-carrinho"></span>
            
        </div><!--header-icons-->
         
    </header>  
    
    <section class="home">
        <div class="home-img">
            <img src="img/product1.png" class="one">
        </div><!--home-img-->

        <div class="home-text">            
            <h1>Headphones <br> Wireless</h1>
            <h5>A maneira mais inteligente de ouvir</h5>            
            <h3>Por Apenas <br> R$299.00</h3>                        
        </div><!--home-text-->
    </section><!--home-->

    <div class="main">
        <div class="row">
            <li><img src="img/main1.png" onclick="slider('img/product1.png')"></li>
        </div><!--row-->

        <div class="row2">
            <li><img src="img/main2.png" onclick="slider('img/product2.png')"></li>
        </div><!--row2-->

        <div class="row3">
            <li><img src="img/main3.png" onclick="slider('img/product3.png')"></li>
        </div><!--row3-->
    </div><!--main-->

    <div class="produtos">
        <?php        
            include('config.php');

            // Conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar a conexão
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $select = $conn->prepare("SELECT * FROM produtos");
            $select->execute();

            // Obter o resultado da consulta
            $result = $select->get_result();

            // Verificar se a consulta retornou resultados
            if ($result->num_rows > 0) {
                // Loop através dos resultados e exibir os produtos
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='produtos'>";
                        echo "<div class='produto'>";
                            echo "<img src='img/" . $row["id"] . ".png' alt='" . $row["nome"] . "'>";
                            echo "<div class='produto-detalhes'>";
                                echo "<h2>" . $row["nome"] . "</h2>";
                                echo "<p>" . $row["descricao"] . "</p>";
                                echo "<p>Estoque: " . $row["quantidade"] . "</p>";
                                echo '<button class="adicionar_ao_carrinho" style="margin: 0;" data-product-id="' . $row["id"] . '" data-product-description="' . $row["descricao"] . '" data-product-price="' . $row["preco"] . '"><b>Add</b> <i class="bx bxs-cart"></i> </button>';                       
                                

                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                
            } else {
                echo "Nenhum produto encontrado no banco de dados.";
            }

            // Fechar a conexão com o banco de dados
            $conn->close();

        ?>
    </div><br><br>
    <div class="produto-carousel-container">
        <div class="produto-carousel">
            <?php        
                include('config.php');

                // Conexão com o banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar a conexão
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $select = $conn->prepare("SELECT * FROM produtos");
                $select->execute();

                // Obter o resultado da consulta
                $result = $select->get_result();

                // Verificar se a consulta retornou resultados
                if ($result->num_rows > 0) {
                    // Loop através dos resultados e exibir os produtos
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='produtos'>";
                            echo "<div class='produto'>";
                                echo "<img src='img/" . $row["id"] . ".png' alt='" . $row["nome"] . "'>";
                                echo "<div class='produto-detalhes'>";
                                    echo "<h2>" . $row["nome"] . "</h2>";
                                    echo "<p>" . $row["descricao"] . "</p>";
                                    echo "<p>Estoque: " . $row["quantidade"] . "</p>";
                                    echo '<button class="adicionar_ao_carrinho" style="margin: 0;" data-product-id="' . $row["id"] . '" data-product-description="' . $row["descricao"] . '" data-product-price="' . $row["preco"] . '"><b>Add</b> <i class="bx bxs-cart"></i> </button>';                       
                                    

                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                    
                } else {
                    echo "Nenhum produto encontrado no banco de dados.";
                }

                // Fechar a conexão com o banco de dados
                $conn->close();
            ?>
        </div>
        
    </div>   

    <!--Add ao carrinho-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".adicionar_ao_carrinho").click(function(e) {
                e.preventDefault();
                var productId = $(this).data("product-id");
                var productDescription = $(this).data("product-description"); 
                var productPrice = $(this).data("product-price"); 
                $.ajax({
                    type: "POST",
                    url: "adicionar_ao_carrinho.php",
                    data: {
                        id_produto: productId,
                        descricao: productDescription, //descrição do produto
                        preco: productPrice //preço do produto
                    },
                    success: function(response) {                        
                        
                    },
                    error: function() {
                        alert("Erro ao adicionar ao carrinho");
                    }
                });
            });
        });
    </script>

    <!--Função pra coma s imagens menores irem para imagem grande-->
    <script>
        function slider (anything){
            document.querySelector ('.one') .src = anything;
        };

       let menu = document.querySelector ('#menu-icon');
       let navbar = document.querySelector ('.navbar');       
    </script><br><br>
    
    

    <!--footer-->
    <div id="footer"></div>

    <script src="js/produtos.js"></script>

    <!--JavaScript para chamar as partes separadas do codigo-->
    <script src="js/particionamento-script.js"></script>
    
    <script src="js/carrousel-produtos.js"></script>
    <!-- Slick Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
</body>
</html>

