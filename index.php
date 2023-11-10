<?php 
        
    session_start();    

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
    <title>Tela de Login</title>
    <!-- Custom JavaScript / JQuery puxa as partes eparadas do html ex.: footer, main-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="estilos/index-style.css">
    <link rel="stylesheet" href="estilos/footer-style.css">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    

    <!--Link das fontes dos icones-->    
    <link rel="stylesheet" type="text/css" href="estilos/fonts-icones.css">
    
    <!--Carroussel-->    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
<body>
    <div class="mensagem-erro" id="erro-mensagem"></div>
    
    <header>
        <a href="#" class="logo"><img src="img/logo.png" alt="Logo da ELCTRO WORLD" width="5%" >GE EXPRESS</a>

        <ul class="navegação">            
            <li><a href="#" id="login-link"><b>Login</b></a></li>
        </ul><!--navegação-->        
    </header>    

    <div class="login-container">
        <div class="login-form">
            <form action="processar_login.php" method="POST">
                <h1>Login</h1><br>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required><br><br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" ><br><br>

                <input type="submit" value="Entrar"><br><br>
                
                <p>Não possui uma conta? <br><a href="cadastro.php" >CADASTRE-SE</a></p>
            </form>  
            </form>
        </div>
    </div>     
            
    <section class="home">
        <div class="home-img">
            <img src="img/product1.png" class="one">
        </div><!--home-img-->

        <div class="home-text">            
            <h1>Headphones <br> Wireless</h1>
            <h5>A maneira mais inteligente de ouvir</h5>           
                                   
        </div><!--home-text-->
        
    </section><!--home-->


    <div class="main">
        <div class="row">
            <li><img src="img/main1.png" onclick="slider('product1.png')"></li>
        </div><!--row-->

        <div class="row2">
            <li><img src="img/main2.png" onclick="slider('product2.png')"></li>
        </div><!--row2-->

        <div class="row3">
            <li><img src="img/main3.png" onclick="slider('product3.png')"></li>
        </div><!--row3-->
    </div><!--main-->

     
    <!--script das imagens pequenas para com ficar maior-->
   <script>
        function slider (anything){
            document.querySelector ('.one') .src = anything;
        };

       let menu = document.querySelector ('#menu-icon');
       let navbar = document.querySelector ('.navbar');       
    </script>
        
    <div class="produto-carousel-container">
        <div class="produto-carousel">
            <?php        
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
        
    </div>   <br><br>
    
    <!--Main-->
    <div id="footer"></div>

    <script src="js/index.js"></script>
    <script src="js/particionamento-script.js"></script>
    <script src="js/carrousel-produtos.js"></script>
    <!-- Slick Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>

