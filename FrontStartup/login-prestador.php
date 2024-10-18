<?php
session_start(); 
require_once './inc/header.php';
?>

<!-- Estilo específico da página de login -->
<link rel="stylesheet" href="css/style-login.css">

<!-- Wrapper para centralizar o login e o footer -->
<div class="wrapper">
    <!-- Container para o formulário de login -->
    <div class="login-container">
        <h1>Login do Prestador</h1>

        <!-- Formulário de login -->
        <form method="POST">
            <!-- Campo de email (Usuário) -->
            <div class="input-group">
                <label for="email">Usuário:</label>
                <input type="text" name="email" placeholder="Digite seu email" required>
            </div>

            <!-- Campo de senha -->
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>

            <!-- Botão de submissão -->
            <div class="button-group">
                <button type="submit">Entrar</button>
            </div>

            <!-- Login com Google -->
            <div class="google-login">
                <button type="button" onclick="window.location.href='login-google.php';">
                    <img src="img/google-icon.png" alt="Google"> Entrar com Google
                </button>
            </div>

            <!-- Links para recuperação de senha e criar conta -->
            <div class="extra-links">
                <a href="esqueci-senha.php">Esqueci minha senha</a>
                <span>|</span>
                <a href="cadastroPrestador.php">Criar nova conta</a>
            </div>
        </form>

        <!-- Mensagem de erro ou sucesso (Opcional) -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="message"><?php echo $_SESSION['login_error']; ?></div>
        <?php endif; ?>
    </div>

    <!-- Incluindo o rodapé -->
    <?php include 'inc/footer.php'; ?>
</div>
