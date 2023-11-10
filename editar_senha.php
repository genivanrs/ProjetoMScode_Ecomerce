<?php
    session_start();
    // Verifique se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }

    $nomeCliente = "Nome do Cliente"; // Substitue-se pelo nome do cliente logado 
    
    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "ecomerce";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    $mensagem = ""; //inicializa a mensagem

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processar o formulário de edição do perfil aqui
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $endereco = $_POST['endereco'];
        $contato = $_POST['contato'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        
        // Atualizar os dados do perfil no banco de dados
        $sql = "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', endereco='$endereco', contato='$contato', senha='$senha' WHERE id=" . $_SESSION['usuario_id'];
        
        if ($conn->query($sql) === TRUE) {
            header("Location: produtos.php?mensagem=Perfil atualizado com sucesso!");
        } else {
            echo "Erro ao atualizar o perfil: " . $conn->error;
        }
    } else {
        // Recupere os dados atuais do perfil do usuário
        $query = "SELECT nome, sobrenome, endereco, contato FROM usuarios WHERE id=" . $_SESSION['usuario_id'];
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
            $sobrenome = $row['sobrenome'];
            $endereco = $row['endereco'];
            $contato = $row['contato'];
        }
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    
    <link rel="stylesheet" href="style/editar-perfil.css"> 
</head>
<body>    
    
    <script>
        // Função para mostrar a mensagem e redirecionar
        function mostrarMensagemERedirecionar() {
            // Selecionar o elemento onde a mensagem será exibida
            var mensagemElement = document.getElementById('mensagem');

            // Exibir a mensagem
            mensagemElement.textContent = "<?php echo $mensagem; ?>";

            // Redirecionar para a página produtos.php após 2 segundos
            setTimeout(function () {
                window.location.href = 'produtos.php';
            }, 2000); // 2000 milissegundos = 2 segundos
        }

        // Verificar se a mensagem está definida e, em seguida, mostrar
        if ("<?php echo $mensagem; ?>" !== "") {
            mostrarMensagemERedirecionar();
        }
    </script>
    
    <header>
        <a href="#" class="logo"><img src="img/logo.png" alt="Logo da ELCTRO WORLD" width="5%" >GE EXPRESS</a>

        <ul class="navegação"> 
            <li class="nome-cliente-li">Olá,</li>
            <li><?php echo $_SESSION['nome_cliente']; ?></li>
            <li><a id="logout" href="logout.php"><b>Logout</b></a></li>            
            <li><a href="produtos.php"><b>Home</b></a></li>
        </ul>          
         
    </header> 
    
    <div class="container">
        <div class="form-center">
            <form method="post" action="editar_perfil.php">
                <h1>Editar Senha</h1><br><br>
                <div class="input-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $nome; ?>" readonly>
                </div>

                <div class="input-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" value="<?php echo $sobrenome; ?>" readonly>
                </div>               
                
                
                <div class="input-group">
                    <label for="senha">Nova Senha:</label>
                    <input type="password" name="senha" required>
                    <br>
                </div>              
                
                <input type="submit" value="Atualizar Perfil">

                <input type="button" value="voltar" onclick="window.location.href='editar_perfil.php';">
                
                <p id="mensagem" style="color: green;"></p> <!-- Elemento para exibir a mensagem -->
            </form>
        </div>
    </div>
</body>
</html>
