<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infoconectados</title>
    <link rel="stylesheet" href="css/style-indexx.css">
</head>
<body>

    <!-- Incluindo a header -->
    <?php include 'inc/header.php'; ?>

    <section class="hero">
        <div class="logo-container">
            <img src="img/logo.png" alt="Infoconectados">
            <h1>INFOCONECTADOS</h1>
            <p class="subtitle">CONECTANDO SOLUÇÕES PARA CLIENTES E PRESTADORES </p>
        </div>
        <nav class="nav-buttons">
            <a href="#">INÍCIO</a>
            <a href="servico.php">SERVIÇOS</a>
            <a href="missaoValores.php">MISSÃO, VISÃO E VALORES</a>
            <a href="#">SOBRE</a>
            <a href="#">CONTATO</a>
            
            <?php if (isset($_SESSION['tipo_usuario'])): ?>
                <!-- Exibe o dashboard conforme o tipo de usuário logado -->
                <?php if ($_SESSION['tipo_usuario'] === 'prestador'): ?>
                    <a href="dashboardPrestador.php">DASHBOARD PRESTADOR</a>
                <?php elseif ($_SESSION['tipo_usuario'] === 'cliente'): ?>
                    <a href="dashboardCliente.php">DASHBOARD CLIENTE</a>
                <?php endif; ?>
                <!-- Opção de logout -->
                <a href="logout.php">SAIR</a>
            <?php else: ?>
                <!-- Opções de login e cadastro para visitantes -->
                <a href="cadastroPrestador.php">CADASTRO</a>
            <?php endif; ?>
        </nav>
    </section>

    <!-- Incluindo o footer -->
    <?php include 'inc/footer.php'; ?>

</body>
</html>
