<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-header.css">
    <title>Infoconectados Php</title>
</head>
<body>
<div class="header">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="Infoconectados Logo">
        </a>
    </div>
    
    <!-- Ícone de menu hamburguer -->
    <div class="menu-icon" onclick="toggleMenu()">
        &#9776; <!-- Símbolo do ícone de menu (três linhas horizontais) -->
    </div>
</div>

<!-- Menu expansível -->
<nav class="nav-menu" id="navMenu">
    <a href="servico.php">Serviço</a>
    <a href="#">Sobre</a>
    <a href="#">Contato</a>
    <a href="missaoValores.php">Missão, Visão e Valores</a>

    <!-- Botões de login no final -->
    <div class="login-buttons">
        <a href="login-cliente.php">Login Cliente</a>
        <a href="login-prestador.php">Login Profissional</a>
    </div>
</nav>


<script>
    // Função para exibir ou ocultar o menu expansível
    function toggleMenu() {
        const menu = document.getElementById('navMenu');
        menu.classList.toggle('show'); // Alternar a classe 'show' para exibir/ocultar o menu
    }
</script>

</body>
</html>
