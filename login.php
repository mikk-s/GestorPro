<?php 
session_start();
require "conexao.php";

if (isset($_SESSION["usuario_id"])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $email = $_POST["login"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario["senha"])) {
        $_SESSION["usuario_id"] = $usuario['id'];
        $_SESSION["usuario"] = $usuario['nome'];
        $_SESSION["perm"] = $usuario['perm']; 
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Credenciais inválidas.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GestorPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">

    <div class="login-card">
        <div class="logo" style="justify-content: center; margin-bottom: 2rem;">
            <div class="logo-icon">G</div>
            GestorPro
        </div>
        
        <h2 style="margin-bottom: 10px;">Bem-vindo de volta</h2>
        <p style="color: var(--secondary-color); margin-bottom: 30px;">Acesse seu painel de controle</p>

        <?php if (isset($erro)): ?>
            <div style="background: #FEE2E2; color: #EF4444; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>E-mail Corporativo</label>
                <input type="email" name="login" class="form-input" placeholder="ex: admin@gestorpro.com" required>
            </div>
            
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Entrar no Sistema</button>
        </form>

        <p style="margin-top: 20px; font-size: 0.9rem;">
            <a href="cadastro.php" style="color: var(--primary-color);">Criar nova conta</a>
        </p>
    </div>

</body>
</html>