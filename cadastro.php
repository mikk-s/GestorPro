<?php
require "conexao.php";
session_start(); 
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $empresa = $_POST["empresa"];

    // Verifica se já existe
    $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->fetchColumn()) {
        $erro = "E-mail já cadastrado.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$empresa, $email, $senhaHash])) {
            $_SESSION['msg'] = "Empresa cadastrada! Faça login.";
            header("Location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empresa - GestorPro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-card">
        <h2>Registrar Empresa</h2>
        <?php if (isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
        <form method="post">
            <div class="form-group">
                <label>Nome da Empresa</label>
                <input type="text" name="empresa" class="form-input" required>
            </div>
            <div class="form-group">
                <label>E-mail Corporativo</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-input" required>
            </div>
            <button type="submit" class="btn-primary" style="width:100%">Criar Conta</button>
        </form>
        <p style="margin-top:15px"><a href="login.php">Já tenho conta</a></p>
    </div>
</body>
</html>