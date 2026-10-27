<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Perfil de Usuário</title>
</head>
<body>
    <h2>Login</h2>

    <form method="post" action="">
        <label for="usuario">Usuário:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <?php
    session_start();

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebe os valores enviados pelo formulário
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Dados para conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "Senai@118";
        $dbname = "exercicio";

        // Conecta ao MySQL
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta o usuário no banco de dados
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $senha);
        $stmt->execute();

        $result = $stmt->get_result();

        // Verifica se encontrou o usuário cadastrado
        if ($result->num_rows > 0) {
            // Cria a sessão do usuário autenticado
            $_SESSION['usuario'] = $usuario;

            // Redireciona para a página de perfil
            header("Location: 15d_desafio3_perfil.php");
            exit();
        } else {
            echo "<p style='color: red;'>Usuário ou senha incorretos!</p>";
        }

        // Fecha a consulta e a conexão
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>