<?php
// Iniciar a sessão, se ainda não estiver iniciada
session_start();

// Destruir a sessão atual (isso desconectará o usuário)
session_destroy();

// Redirecionar o usuário para a página de login ou para a página inicial
header("Location: index.php"); // Altere "index.php" para a página desejada após o logout
exit;
?>
