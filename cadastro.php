<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style/cadastro-style.css">
</head>
<body>   
    <header>
        <a href="#" class="logo"><img src="img/logo.png" alt="Logo da ELCTRO WORLD" width="5%" >GE EXPRESS</a>

        <ul class="navegação">            
            <li><a href="index.php">Home</a></li>
        </ul><!--navegação-->        
    </header>    
     
    <div class="mensagem-erro" id="erro-mensagem"></div>
    
    <form action="processar_cadastro.php" method="POST">
        <h1>Cadastro</h1>
        <div class="container">
            <div class="form-center">
                <div class="form-left">
                    <div class="input-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="input-padrao" required pattern="[A-Za-zÀ-ú\s]+" oninput="this.value = this.value.replace(/[^A-Za-zÀ-ú\s]/g, '');">                       
                    </div>

                    <div class="input-group">
                        <label for="sobrenome">Sobrenome:</label>
                        <input type="text" name="sobrenome" id="sobrenome" class="input-padrao" required pattern="[A-Za-zÀ-ú\s]+" oninput="this.value = this.value.replace(/[^A-Za-zÀ-ú\s]/g, '');">
                    </div>

                    <div class="input-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="input-padrao" required pattern="[0-9]+" oninput="this.value = this.value.replace(/\D/g, '');">
                    </div>

                    <div class="input-group">
                        <label for="contato">Contato:</label>
                        <input type="text" name="contato" id="contato"  class="input-padrao" required pattern="[0-9]+" oninput="this.value = this.value.replace(/\D/g, '');"><br><br>
                    </div>    

                    <div class="input-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="input-padrao" required><br><br>
                    </div>
                    
                    <div class="input-group">
                        <label for="genero" class="label-input">Gênero:</label>
                        <select name="genero" id="genero" class="genero-select">
                            <option value="selecione">Selecione</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div><br>

                    <div class="input-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" class="input-padrao" required><br><br>
                    </div>

                    <div class="input-group">
                        <label for="confirmaSenha">Confirmação de Senha:</label>
                        <input type="password" name="confirmaSenha" class="input-padrao" id="confirmaSenha" required><br><br>
                    </div>
                </div>
                
                <div class="form-right">
                    <div class="input-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="endereco" id="endereco" class="input-padrao" requiredpattern="[A-Za-zÀ-ú\s]+" oninput="this.value = this.value.replace(/[^A-Za-zÀ-ú\s]/g, '');"><br><br>
                    </div>

                    <div class="input-group">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" class="input-padrao" required pattern="[0-9]+" oninput="this.value = this.value.replace(/\D/g, '');">
                    </div>

                    <div class="input-group">
                        <label for="rua">Rua:</label>
                        <input type="text" name="rua" id="rua" class="input-padrao" required>
                    </div>

                    <div class="input-group">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" class="input-padrao" required>
                    </div>

                    <div class="input-group">
                        <label for="referencia">Referência:</label>
                        <input type="text" name="referencia" id="referencia" class="input-padrao" required>
                    </div>

                    <div class="input-group">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" name="logradouro" id="logradouro" class="input-padrao" required>
                    </div>
                </div>   

                <input type="submit" value="Cadastrar"><br><br>               

                <p>Já possui uma conta? <a href="index.php">Clique aqui para fazer login</a></p>
            </div>
        </div>
    </form>   
    
    <script src="js/cadastro.js"></script>
</body>
</html>
