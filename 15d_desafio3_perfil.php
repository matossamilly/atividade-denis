<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: 15d_desafio3_login.php");
    exit();
}

// Define uma cor padrão para o perfil
$cor_fundo = "#ffffff";

// Verifica se o formulário de personalização foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe a cor escolhida pelo usuário
    $cor_fundo = $_POST['cor_fundo'];

    // Salva a cor na sessão
    $_SESSION['cor_fundo'] = $cor_fundo;
}

// Se já existir uma cor salva, utiliza essa cor
if (isset($_SESSION['cor_fundo'])) {
    $cor_fundo = $_SESSION['cor_fundo'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body style="background-color: <?php echo $cor_fundo; ?>;">

    <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>

    <p>Esta é sua página de perfil.</p>
    <p>Apenas usuários autenticados podem acessar esta página.</p>

    <h3>Personalizar cor de fundo</h3>

    <form method="post" action="">
        <label for="cor_fundo">Escolha uma cor:</label>
        <input type="color" name="cor_fundo" value="<?php echo $cor_fundo; ?>" required>
        <button type="submit">Salvar cor</button>
    </form>

    <br>
    <a href="15d_desafio3_logout.php">Logout</a>

</body>
</html>