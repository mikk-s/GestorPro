<?php include_once("templates/header.php"); ?>

<main>
<section class="container hero">
        <div class="hero-content">
            <span class="tag-pill">🚀 TCC - Trabalho de Conclusão de Curso</span>
            
            <h1>Sua Gestão,<br><span class="gradient-text">Simplificada.</span></h1>
            
            <p>O <strong>GestorPro</strong> é a solução definitiva para Empresas que sofrem com a Gestão de produtos. Unificamos controle de estoque, gestão de contratos e relatórios em uma interface limpa e intuitiva.</p>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
                <?php if (!isset($_SESSION['usuario_id'])): ?>
                    <a href="login.php" class="btn-primary">Acessar Sistema</a>
                    <a href="#funcionalidades" style="padding: 12px 28px; border: 1px solid #E2E8F0; border-radius: 50px; color: var(--text-dark); font-weight: 600;">Saber Mais</a>
                <?php else: ?>
                    <a href="dashboard.php" class="btn-primary">Ir para Dashboard</a>
                <?php endif; ?>
            </div>

            <div style="display: flex; align-items: center; gap: 15px; font-size: 0.9rem; color: var(--secondary-color); flex-wrap: wrap;">
                <span><i class="fas fa-check-circle" style="color: #16A34A;"></i> Login Seguro</span>
                <span><i class="fas fa-check-circle" style="color: #16A34A;"></i> Dados em Nuvem</span>
                <span><i class="fas fa-check-circle" style="color: #16A34A;"></i> 100% Responsivo</span>
            </div>
        </div>

        <div class="hero-image">
            <div style="position: absolute; top: -20px; right: -20px; width: 100%; height: 100%; background: linear-gradient(135deg, #E0E7FF 0%, #F3F4F6 100%); border-radius: 20px; z-index: -1;"></div>
            
            <img src="img/width_511.webp" alt="Interface do Sistema" class="hero-card-img">

            <div class="floating-card card-crescimento">
                <div class="icon-box-sm success"><i class="fas fa-chart-line"></i></div>
                <div>
                    <span>Crescimento Mensal</span>
                    <strong>+127%</strong>
                </div>
            </div>

            <div class="floating-card card-estoque">
                <div class="icon-box-sm info"><i class="fas fa-box"></i></div>
                <div>
                    <span>Estoque Atualizado</span>
                    <strong>Sincronizado</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="funcionalidades" class="container">
        <div class="section-title">
            <h2>Tudo o que você precisa</h2>
            <p>Desenvolvemos as ferramentas essenciais para que gestores parem de perder tempo com planilhas e foquem no crescimento.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-chart-pie"></i></div>
                <h3>Dashboard Inteligente</h3>
                <p>Tenha uma visão 360º do seu negócio com gráficos em tempo real sobre vendas, estoque e novos usuários.</p>
            </div>
           
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-box-open"></i></div>
                <h3>Controle de Estoque</h3>
                <p>Nunca mais perca vendas por falta de produto. O GestorPro avisa quando o estoque está baixo.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-mobile-alt"></i></div>
                <h3>Acesso Mobile</h3>
                <p>O sistema foi desenhado para funcionar perfeitamente no seu celular, tablet ou computador.</p>
            </div>
        </div>
        <br><br><br>
    </section>

    <section id="tecnologia" class="tech-section">
        <div class="container">
            <h2 style="margin-bottom: 20px;">Construído com Tecnologia Moderna</h2>
            <p style="color: #94A3B8; max-width: 600px; margin: 0 auto;">Utilizamos uma stack robusta e de mercado para garantir performance e segurança.</p>
            
            <div class="tech-grid">
                <div class="tech-item"><i class="fab fa-php"></i> PHP 8</div>
                <div class="tech-item"><i class="fas fa-database"></i> MySQL</div>
                <div class="tech-item"><i class="fab fa-html5"></i> HTML5</div>
                <div class="tech-item"><i class="fab fa-css3-alt"></i> CSS3</div>
                <div class="tech-item"><i class="fab fa-js"></i> JavaScript</div>
            </div>
        </div>
    </section>

    <section id="equipe" class="container">
        <div class="section-title">
            <br>
            <br>
            <h2>Quem Fez Acontecer</h2>
            <p>Projeto desenvolvido com dedicação para resolver o seu problema.</p>
        </div>

        <div class="team-grid">
            <div class="team-member">
                <img src="img/placeholder.jpg" alt="Aluno 1">
                <h4>Miguel Farnese</h4>
                <span>Fullstack Developer</span>
            </div>
            <div class="team-member">
                <img src="img/placeholder.jpg" alt="Aluno 2">
                <h4>Pablo Faria</h4>
                <span>Frontend & UI</span>
            </div>
            <div class="team-member">
                <img src="img/placeholder.jpg" alt="Aluno 3">
                <h4>Eduarda Ayandra</h4>
                <span>Banco de Dados</span>
            </div>
             <div class="team-member">
                <img src="img/placeholder.jpg" alt="Aluno 4">
                <h4>Iran Trindade</h4>
                <span>Documentação</span>
            </div>
               <div class="team-member">
                <img src="img/placeholder.jpg" alt="Aluno 5">
                <h4>Sophia Teixeira</h4>
                <span>Documentação</span>
            </div>
        </div>
        <br><br>
    </section>

    <section class="container" style="padding-bottom: 80px;">
        <div style="background: var(--primary-color); border-radius: 20px; padding: 60px 40px; text-align: center; color: white; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);"></div>
            
            <h2 style="font-size: 2.5rem; margin-bottom: 20px; position: relative; z-index: 2;">Pronto para testar?</h2>
            <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9; position: relative; z-index: 2;">O GestorPro é open-source e acadêmico. Acesse a demonstração agora mesmo.</p>
            
            <a href="login.php" style="background: white; color: var(--primary-color); padding: 15px 40px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; display: inline-block; position: relative; z-index: 2; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                Acessar Demonstração <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
            </a>
        </div>
    </section>
</main>

<footer>
    <div class="container">
        <p>&copy; 2025 GestorPro - Trabalho de Conclusão de Curso.</p>
        <p style="font-size: 0.85rem; margin-top: 10px;">Desenvolvido para fins educacionais.</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>