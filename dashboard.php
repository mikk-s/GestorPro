<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Estatísticas Reais
$id_empresa = $_SESSION['usuario_id'];

// Total de Equipamentos
$total_eq = $conn->prepare("SELECT COUNT(*) FROM equipamentos WHERE id_empresa = ?");
$total_eq->execute([$id_empresa]);
$total_eq = $total_eq->fetchColumn();

// Total Alugado
$total_alugado = $conn->prepare("SELECT COUNT(*) FROM equipamentos WHERE id_empresa = ? AND status_aluguel = 'Alugado'");
$total_alugado->execute([$id_empresa]);
$total_alugado = $total_alugado->fetchColumn();

// Valor Total do Patrimônio
$valor_patrimonio = $conn->prepare("SELECT SUM(preco) FROM equipamentos WHERE id_empresa = ?");
$valor_patrimonio->execute([$id_empresa]);
$valor_patrimonio = $valor_patrimonio->fetchColumn() ?: 0;

?>
<?php include_once("templates/header.php"); ?>

<div class="dashboard-layout">
    <?php include "templates/sidebar.php"; ?>

    <main class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h2 style="font-size: 1.8rem;">Visão Geral</h2>
                <p style="color: var(--secondary-color);">Resumo das atividades hoje, <?= date('d/m/Y') ?></p>
            </div>
            <a href="cadastrar_equipamento.php" class="btn-primary" style="text-decoration: none;">
                <i class="fas fa-plus"></i> Novo Equipamento
            </a>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Valor do Patrimônio</div>
                    <i class="fas fa-dollar-sign" style="color: #10B981; background: #D1FAE5; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number">R$ <?= number_format($valor_patrimonio, 2, ',', '.') ?></div>
                <div style="color: #10B981; font-size: 0.85rem; margin-top: 5px;">Total em ativos</div>
            </div>

            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Total de Ativos</div>
                    <i class="fas fa-box" style="color: var(--primary-color); background: #DBEAFE; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number"><?= $total_eq ?></div>
                <div style="color: var(--secondary-color); font-size: 0.85rem; margin-top: 5px;">Equipamentos cadastrados</div>
            </div>

            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Itens Alugados</div>
                    <i class="fas fa-hand-holding" style="color: #F59E0B; background: #FEF3C7; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number"><?= $total_alugado ?></div>
                <div style="color: #F59E0B; font-size: 0.85rem; margin-top: 5px;">Fora do estoque</div>
            </div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: var(--shadow-card);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Últimos Equipamentos Cadastrados</h3>
                <a href="meus_ativos.php" style="color: var(--primary-color); font-weight: 600;">Ver todos</a>
            </div>
            
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; color: var(--secondary-color); border-bottom: 1px solid #E2E8F0;">
                        <th style="padding-bottom: 15px;">Modelo</th>
                        <th style="padding-bottom: 15px;">Numeração</th>
                        <th style="padding-bottom: 15px;">Status</th>
                        <th style="padding-bottom: 15px;">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Busca os 5 últimos
                    $ultimos = $conn->prepare("SELECT * FROM equipamentos WHERE id_empresa = ? ORDER BY id DESC LIMIT 5");
                    $ultimos->execute([$id_empresa]);
                    $lista_ultimos = $ultimos->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    
                    <?php if(count($lista_ultimos) > 0): ?>
                        <?php foreach($lista_ultimos as $item): ?>
                        <tr style="border-bottom: 1px solid #F8FAFC;">
                            <td style="padding: 15px 0; font-weight: 600;"><?= htmlspecialchars($item['nome_modelo']) ?></td>
                            <td style="color: #666;"><?= htmlspecialchars($item['numeracao']) ?></td>
                            <td>
                                <span style="background: <?= $item['status_aluguel'] == 'Disponivel' ? '#D1FAE5' : '#FEF3C7' ?>; 
                                             color: <?= $item['status_aluguel'] == 'Disponivel' ? '#065F46' : '#92400E' ?>; 
                                             padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">
                                    <?= $item['status_aluguel'] ?>
                                </span>
                            </td>
                            <td style="font-weight: 600;">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="padding: 20px; text-align: center;">Nenhum registro ainda.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>