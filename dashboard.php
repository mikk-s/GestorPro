<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Simulação de dados para o MVP (já que removemos eventos, usamos dados 'fake' ou conta usuarios)
$total_usuarios = $conn->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
?>
<?php include_once("templates/header.php"); ?>

<div class="dashboard-layout">
    <aside class="sidebar">
        <div style="margin-bottom: 30px;">
            <p style="font-size: 0.8rem; text-transform: uppercase; color: #94A3B8; font-weight: 700; letter-spacing: 1px;">Principal</p>
        </div>
        <nav>
            <a href="#" class="sidebar-link active"><i class="fas fa-home"></i> Visão Geral</a>
            <a href="#" class="sidebar-link"><i class="fas fa-box"></i> Estoque</a>
            <a href="#" class="sidebar-link"><i class="fas fa-users"></i> Equipe</a>
            <a href="#" class="sidebar-link"><i class="fas fa-chart-pie"></i> Relatórios</a>
            <div style="margin: 20px 0; border-top: 1px solid #F1F5F9;"></div>
            <a href="gerenciar_usuarios.php" class="sidebar-link"><i class="fas fa-cog"></i> Configurações</a>
        </nav>
    </aside>

    <main class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h2 style="font-size: 1.8rem;">Visão Geral</h2>
                <p style="color: var(--secondary-color);">Resumo das atividades hoje, <?= date('d/m/Y') ?></p>
            </div>
            <button class="btn-primary" style="padding: 10px 20px; font-size: 0.9rem;"><i class="fas fa-download"></i> Exportar Dados</button>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Receita Total</div>
                    <i class="fas fa-dollar-sign" style="color: #10B981; background: #D1FAE5; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number">R$ 45.200</div>
                <div style="color: #10B981; font-size: 0.85rem; margin-top: 5px;"><i class="fas fa-arrow-up"></i> +12% esse mês</div>
            </div>

            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Usuários Ativos</div>
                    <i class="fas fa-users" style="color: var(--primary-color); background: #DBEAFE; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number"><?= $total_usuarios ?></div>
                <div style="color: var(--secondary-color); font-size: 0.85rem; margin-top: 5px;">Cadastrados no sistema</div>
            </div>

            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="stat-label">Tarefas Pendentes</div>
                    <i class="fas fa-tasks" style="color: #F59E0B; background: #FEF3C7; padding: 8px; border-radius: 50%;"></i>
                </div>
                <div class="stat-number">12</div>
                <div style="color: #F59E0B; font-size: 0.85rem; margin-top: 5px;">3 urgentes</div>
            </div>
        </div>

        <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: var(--shadow-card);">
            <h3 style="margin-bottom: 20px;">Atividades Recentes</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; color: var(--secondary-color); border-bottom: 1px solid #E2E8F0;">
                        <th style="padding-bottom: 15px;">ID</th>
                        <th style="padding-bottom: 15px;">Atividade</th>
                        <th style="padding-bottom: 15px;">Status</th>
                        <th style="padding-bottom: 15px;">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #F8FAFC;">
                        <td style="padding: 15px 0;">#1024</td>
                        <td>Atualização de Estoque (Notebooks)</td>
                        <td><span style="background: #D1FAE5; color: #065F46; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">Concluído</span></td>
                        <td style="color: var(--secondary-color);">Hoje, 10:42</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px 0;">#1025</td>
                        <td>Novo usuário cadastrado</td>
                        <td><span style="background: #DBEAFE; color: #1E40AF; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">Info</span></td>
                        <td style="color: var(--secondary-color);">Hoje, 09:15</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>