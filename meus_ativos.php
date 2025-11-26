<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_empresa = $_SESSION['usuario_id'];
$filtro_estado = $_GET['estado'] ?? '';
$filtro_status = $_GET['status'] ?? '';
$busca = $_GET['busca'] ?? '';

// Monta a Query com filtros
$sql = "SELECT * FROM equipamentos WHERE id_empresa = :id_empresa";
$params = [':id_empresa' => $id_empresa];

if ($filtro_estado) {
    $sql .= " AND estado = :estado";
    $params[':estado'] = $filtro_estado;
}
if ($filtro_status) {
    $sql .= " AND status_aluguel = :status";
    $params[':status'] = $filtro_status;
}
if ($busca) {
    $sql .= " AND (nome_modelo LIKE :busca OR numeracao LIKE :busca)";
    $params[':busca'] = "%$busca%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include_once("templates/header.php"); ?>

<div class="dashboard-layout">
    
    <?php include "templates/sidebar.php"; ?>

    <main class="main-content">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Meus Ativos</h2>
            <a href="cadastrar_equipamento.php" class="btn-primary">+ Novo Equipamento</a>
        </div>

        <form class="filter-bar" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
            <input type="text" name="busca" placeholder="Buscar por nome ou numeração..." value="<?= htmlspecialchars($busca) ?>" class="form-input" style="flex: 2;">
            
            <select name="estado" class="form-input" style="flex: 1;">
                <option value="">Todos os Estados</option>
                <option value="Novo" <?= $filtro_estado == 'Novo' ? 'selected' : '' ?>>Novo</option>
                <option value="Usado" <?= $filtro_estado == 'Usado' ? 'selected' : '' ?>>Usado</option>
                <option value="Manutenção" <?= $filtro_estado == 'Manutenção' ? 'selected' : '' ?>>Em Manutenção</option>
            </select>

            <select name="status" class="form-input" style="flex: 1;">
                <option value="">Todos os Status</option>
                <option value="Disponivel" <?= $filtro_status == 'Disponivel' ? 'selected' : '' ?>>Em Estoque</option>
                <option value="Alugado" <?= $filtro_status == 'Alugado' ? 'selected' : '' ?>>Alugado</option>
            </select>

            <button type="submit" class="btn-primary">Filtrar</button>
            <a href="meus_ativos.php" style="padding: 10px; color: #666;">Limpar</a>
        </form>

        <div class="equipment-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php if (count($equipamentos) > 0): ?>
                <?php foreach ($equipamentos as $eq): ?>
                    <div class="card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee;">
                        <div style="height: 180px; overflow: hidden; background: #f4f4f4; display: flex; align-items: center; justify-content: center;">
                            <?php if ($eq['imagem']): ?>
                                <img src="<?= $eq['imagem'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <i class="fas fa-box" style="font-size: 3rem; color: #ccc;"></i>
                            <?php endif; ?>
                        </div>
                        <div style="padding: 20px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="font-size: 0.8rem; background: #eee; padding: 2px 8px; border-radius: 4px;"><?= htmlspecialchars($eq['numeracao']) ?></span>
                                <span style="font-size: 0.8rem; color: <?= $eq['status_aluguel'] == 'Disponivel' ? 'green' : 'orange' ?>; font-weight: bold;">
                                    <?= $eq['status_aluguel'] == 'Disponivel' ? 'Em Estoque' : 'Alugado' ?>
                                </span>
                            </div>
                            <h3 style="margin: 10px 0; font-size: 1.2rem;"><?= htmlspecialchars($eq['nome_modelo']) ?></h3>
                            
                            <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;">
                                <i class="fas fa-calendar"></i> Fab: <?= date('d/m/Y', strtotime($eq['data_fabricacao'])) ?>
                            </p>
                            <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;">
                                <i class="fas fa-tools"></i> Estado: <?= htmlspecialchars($eq['estado']) ?>
                            </p>
                            <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;">
                                <i class="fas fa-map-marker-alt"></i> Local: <strong><?= htmlspecialchars($eq['localizacao']) ?></strong>
                            </p>
                            
                            <h4 style="color: var(--primary-color);">R$ <?= number_format($eq['preco'], 2, ',', '.') ?></h4>
                            
                            <a href="detalhes_equipamento.php?id=<?= $eq['id'] ?>" class="btn-primary" style="display: block; text-align: center; margin-top: 15px; border-radius: 6px;">Ver Detalhes</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum equipamento encontrado.</p>
            <?php endif; ?>
        </div>

    </main>
</div>