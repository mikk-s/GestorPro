<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $numeracao = $_POST['numeracao'] ?: 'EQ-' . time(); // Auto numeração se vazio
    $data_fab = $_POST['data_fab'];
    $estado = $_POST['estado'];
    $local = $_POST['local'];
    $preco = $_POST['preco'];
    
    // Upload simples
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $dir = "img/uploads/";
        if (!is_dir($dir)) mkdir($dir);
        $imagem = $dir . uniqid() . ".jpg";
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
    }

    $sql = "INSERT INTO equipamentos (nome_modelo, numeracao, data_fabricacao, estado, localizacao, preco, imagem, id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome, $numeracao, $data_fab, $estado, $local, $preco, $imagem, $_SESSION['usuario_id']]);
    
    header("Location: dashboard.php");
    exit();
}
include_once("templates/header.php");
?>
<div class="container" style="padding-top: 120px; max-width: 600px;">
    <div class="login-card" style="margin: 0 auto;">
        <h2>Novo Equipamento</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nome / Modelo</label>
                <input type="text" name="nome" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Numeração (Deixe vazio para gerar auto)</label>
                <input type="text" name="numeracao" class="form-input">
            </div>
            <div class="form-group">
                <label>Data de Fabricação</label>
                <input type="date" name="data_fab" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-input">
                    <option value="Novo">Novo</option>
                    <option value="Usado">Usado</option>
                    <option value="Manutenção">Manutenção</option>
                </select>
            </div>
            <div class="form-group">
                <label>Localização (Estoque)</label>
                <input type="text" name="local" class="form-input" placeholder="Ex: Prateleira B3" required>
            </div>
            <div class="form-group">
                <label>Preço (Valor do Ativo)</label>
                <input type="number" step="0.01" name="preco" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="imagem" class="form-input">
            </div>
            <button type="submit" class="btn-primary" style="width: 100%;">Salvar Equipamento</button>
        </form>
    </div>
</div>