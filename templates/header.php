<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
// Base URL manual para garantir links corretos
$BASE_URL = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'].'?'). '/';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestorPro - Gestão Inteligente</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container">
        <nav class="navbar">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="GestorPro Soluções" class="logo-img">
            </a>

            <div class="nav-links">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="gerenciar_usuarios.php">Usuários</a>
                    <div style="width: 1px; height: 20px; background: #E2E8F0;"></div>
                    <span>Olá, <strong><?= explode(' ', $_SESSION['usuario'])[0] ?></strong></span>
                    <a href="deslogar.php" style="color: #EF4444;">Sair</a>
                <?php else: ?>
                    <a href="index.php#funcionalidades">Funcionalidades</a>
                    <a href="index.php#tecnologia">Tecnologia</a>
                    <a href="index.php#equipe">A Equipe</a>
                    <a href="login.php" class="btn-primary"><i class="fas fa-play-circle"></i> Live Demo</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>