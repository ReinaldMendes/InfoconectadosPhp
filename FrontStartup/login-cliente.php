<?php
session_start(); 
require_once './inc/header.php';
?>

<!-- Estilo específico da página de login -->
<link rel="stylesheet" href="css/style-login.css">

<br><br>

<!-- Container para o formulário de login -->
<div class="login-container">
    <h1>Login do Cliente</h1>

    <!-- Formulário de login -->
    <form method="POST">
        <!-- Campo de email (Usuário) -->
        <div>
            <label for="email">Usuário:</label>
            <input type="text" name="email" placeholder="Digite seu email" required>
        </div>

        <!-- Campo de senha -->
        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
        </div>

        <!-- Botão de submissão -->
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>

    <!-- Mensagem de erro ou sucesso (Opcional) -->
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="message"><?php echo $_SESSION['login_error']; ?></div>
    <?php endif; ?>
</div>

<br><br>

<!-- Incluindo o rodapé -->
<?php include 'inc/footer.php'; ?>
