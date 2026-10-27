<?php
// Inicia a sessão
session_start();

// Encerra a sessão do usuário
session_destroy();

// Redireciona para a página de login
header("Location: 15d_desafio3_login.php");
exit();
?>