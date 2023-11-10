<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="style/inserir_produtos_style.css">
</head>
<body>
    <h1>Adicionar Produto</h1>
    <h3>Bem vindo, Admin</h3>
    <h3 id="voltar_home"><a href="produtos.php">Home</a></h3>
    <div class="container">
    <form action="adicionar_produto.php" method="post">
        <label for="nome">Nome do Produto:</label><br>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" required></textarea><br>

        <label for="preco">Preço:</label><br>
        <input type="text" name="preco" required><br>

        <label for="quantidade">Quantidade em Estoque:</label><br>
        <input type="number" name="quantidade" required><br><br>

        <button type="submit">Adicionar Produto</button>
    </form>
    </div>
</body>
</html>
