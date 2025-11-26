<?php
session_start();
require_once 'conexao.php';

if (!isset($_GET['id'])) header("Location: dashboard.php");
$id = $_GET['id'];

// Processar novo aluguel
if (isset($_POST['alugar'])) {
    $locatario = $_POST['locatario'];
    $email = $_POST['email'];
    $data_fim = $_POST['data_fim'];
    
    // Atualiza status equipamento
    $conn->prepare("UPDATE equipamentos SET status_aluguel = 'Alugado', localizacao = 'Com Cliente' WHERE id = ?")->execute([$id]);
    
    // Cria registro aluguel
    $stmt = $conn->prepare("INSERT INTO alugueis (id_equipamento, nome_locatario, email_locatario, data_inicio, data_fim) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->execute([$id, $locatario, $email, $data_fim]);
    header("Refresh:0");
}

// Processar devolução
if (isset($_POST['devolver'])) {
    $conn->prepare("UPDATE equipamentos SET status_aluguel = 'Disponivel', localizacao = 'Estoque' WHERE id = ?")->execute([$id]);
    $conn->prepare("UPDATE alugueis SET status_ativo = 0 WHERE id_equipamento = ?")->execute([$id]);
    header("Refresh:0");
}

// Busca dados do equipamento
$stmt = $conn->prepare("SELECT * FROM equipamentos WHERE id = ? AND id_empresa = ?");
$stmt->execute([$id, $_SESSION['usuario_id']]);
$eq = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$eq) die("Equipamento não encontrado.");

// Busca dados do aluguel ativo (se houver)
$aluguel = null;
if ($eq['status_aluguel'] == 'Alugado') {
    $stmt_aluguel = $conn->prepare("SELECT * FROM alugueis WHERE id_equipamento = ? AND status_ativo = 1");
    $stmt_aluguel->execute([$id]);
    $aluguel = $stmt_aluguel->fetch(PDO::FETCH_ASSOC);
}
?>
<?php include_once("templates/header.php"); ?>

<div class="container" style="padding-top: 120px; display: flex; gap: 40px; flex-wrap: wrap;">
    
    <div style="flex: 1; min-width: 300px;">
        <div style="border-radius: 15px; overflow: hidden; border: 1px solid #eee; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
            <img src="<?= $eq['imagem'] ?: 'img/placeholder.jpg' ?>" style="width: 100%; height: auto;">
        </div>
    </div>

    <div style="flex: 1.5; min-width: 300px;">
        <h1 style="margin-bottom: 10px;"><?= htmlspecialchars($eq['nome_modelo']) ?></h1>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <span class="tag-pill" style="margin:0"><?= htmlspecialchars($eq['numeracao']) ?></span>
            <span class="tag-pill" style="margin:0; background: <?= $eq['status_aluguel'] == 'Disponivel' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $eq['status_aluguel'] == 'Disponivel' ? 'green' : 'red' ?>">
                <?= $eq['status_aluguel'] ?>
            </span>
        </div>

        <div style="background: white; padding: 25px; border-radius: 10px; border: 1px solid #eee; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px;">Ficha Técnica</h3>
            <p><strong>Data Fabricação:</strong> <?= date('d/m/Y', strtotime($eq['data_fabricacao'])) ?></p>
            <p><strong>Estado:</strong> <?= htmlspecialchars($eq['estado']) ?></p>
            <p><strong>Localização Atual:</strong> <?= htmlspecialchars($eq['localizacao']) ?></p>
            <p><strong>Valor do Ativo:</strong> R$ <?= number_format($eq['preco'], 2, ',', '.') ?></p>
        </div>

        <?php if ($eq['status_aluguel'] == 'Alugado' && $aluguel): ?>
            <div style="background: #eff6ff; padding: 25px; border-radius: 10px; border: 1px solid #bfdbfe;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">Atualmente Alugado para:</h3>
                <p><strong>Nome:</strong> <?= htmlspecialchars($aluguel['nome_locatario']) ?></p>
                <p><strong>E-mail:</strong> <?= htmlspecialchars($aluguel['email_locatario']) ?></p>
                <p><strong>Devolução Prevista:</strong> <?= date('d/m/Y', strtotime($aluguel['data_fim'])) ?></p>
                
                <form method="POST" style="margin-top: 20px;">
                    <button type="submit" name="devolver" class="btn-primary" style="background: #ef4444;">Registrar Devolução</button>
                </form>
            </div>
        <?php else: ?>
            <div style="background: #f9fafb; padding: 25px; border-radius: 10px; border: 1px solid #e5e7eb;">
                <h3>Registrar Saída (Aluguel)</h3>
                <form method="POST">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                        <input type="text" name="locatario" placeholder="Nome do Cliente/Funcionário" class="form-input" required>
                        <input type="email" name="email" placeholder="E-mail de contato" class="form-input" required>
                        <input type="date" name="data_fim" class="form-input" required title="Data Prevista de Devolução">
                        <button type="submit" name="alugar" class="btn-primary">Confirmar Saída</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
        
        <br>
        <a href="meus_ativos.php" style="color: #666;">&larr; Voltar para lista</a>
    </div>
</div>