<aside class="sidebar">
    <div style="margin-bottom: 30px;">
        <p style="font-size: 0.8rem; text-transform: uppercase; color: #94A3B8; font-weight: 700; letter-spacing: 1px;">Principal</p>
    </div>
    <nav>
        <a href="dashboard.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Visão Geral
        </a>
        <a href="meus_ativos.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'meus_ativos.php' ? 'active' : '' ?>">
            <i class="fas fa-box"></i> Meus Ativos
        </a>
        <a href="#" class="sidebar-link">
            <i class="fas fa-users"></i> Equipe
        </a>
        <a href="#" class="sidebar-link">
            <i class="fas fa-chart-pie"></i> Relatórios
        </a>
        <div style="margin: 20px 0; border-top: 1px solid #F1F5F9;"></div>
        <a href="#" class="sidebar-link">
            <i class="fas fa-cog"></i> Configurações
        </a>
        <a href="deslogar.php" class="sidebar-link" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
    </nav>
</aside>