<?php
include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Inicialize variáveis de erro e mensagens de erro
$erros = false;
$mensagens_erro = [];

// Obtém os dados do formulário de cadastro
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$contato = $_POST['contato'];
$genero = $_POST['genero'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Validações 
if (empty($nome)) {
    $erros = true;
    $mensagens_erro[] = "O campo Nome é obrigatório.";
}

if (empty($email)) {
    $erros = true;
    $mensagens_erro[] = "O campo E-mail é obrigatório.";
}

// adicionar aqui mais validações

// Se houver erros, redirecione para a página de cadastro com as mensagens de erro
if ($erros) {
    $mensagens_erro = implode('<br>', $mensagens_erro); // Converte as mensagens de erro em uma única string
    header("Location: cadastro.php?erro=$mensagens_erro");
    exit;
}

// Se não houver erros, insira os dados no banco de dados
$sql = "INSERT INTO usuarios (nome, sobrenome, endereco, cpf, contato, genero, email, senha)
VALUES ('$nome', '$sobrenome', '$endereco', '$cpf', '$contato', '$genero', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    $mensagem_sucesso = "Cadastro realizado com sucesso!";
} else {
    $mensagem_erro = "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>
        /* Estilos para a sobreposição modal */
        .modal-overlay {
            display: none;
            
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            justify-content: center;
            align-items: center;
            
            text-align: center;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #1d2631;
            color: #ffffff;
            margin-top: 30px;
        }

        /* Estilos para o modal específico */
        .modal-container {
            
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center; /* Centraliza o conteúdo horizontalmente */
        }


    </style>
</head>
<body>
    
    <div class="modal-overlay" id="modal" style="display: none;">
        <div id="confirmacao-mensagem">Cadastro realizado com sucesso!</div>
    </div>

    <script>
        // Selecionar os elementos do modal
        const modal = document.getElementById('modal');
        const mensagemModal = document.getElementById('confirmacao-mensagem');

        // Função para exibir o modal
        function exibirModal() {
            modal.style.display = 'flex';

            // Redirecionar para index.php após 2 segundos
            setTimeout(function () {
                modal.style.display = 'none'; // Oculta o modal
                window.location.href = 'index.php'; // Redireciona após o modal ser oculto
            }, 2500);
        }

        // Verificar se o cadastro foi bem-sucedido (você pode ajustar isso com base na sua lógica)
        const sucesso = true;

        if (sucesso) {
            mensagemModal.textContent = "Cadastro realizado com sucesso!";
            exibirModal();
        }

    </script>
</body>
</html>
