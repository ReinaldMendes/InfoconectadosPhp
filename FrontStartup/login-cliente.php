<?php
session_start();
require_once 'inc/header.php'; // Inclui o cabeçalho da página
require_once '../adm/classes/cliente.php'; // Verifique se o caminho está correto

// Inicializa a mensagem de erro
$mensagemErro = '';

// Processa o formulário ao submeter os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos de email e senha estão preenchidos
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        // Instancia a classe Cliente
        $cliente = new Cliente();

        // Captura os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Executa o login e captura o resultado
        if ($cliente->fazerLogin($email, $senha)) {
            header("Location: dashboardCliente.php"); // Redireciona para o dashboard do cliente
            exit;
        } else {
            $mensagemErro = 'Email ou senha inválidos.';
        }
    } else {
        $mensagemErro = 'Por favor, preencha todos os campos.';
    }
}
?>

<!-- Estilo específico da página de login -->
<link rel="stylesheet" href="css/style-login.css">

<div class="wrapper">
    <div class="login-container">
        <h1>Login do Cliente</h1>

        <!-- Formulário de login -->
        <form method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div class="button-group">
                <button type="submit">Entrar</button>
            </div>
            <div class="google-login">
                <button type="button" onclick="window.location.href='login-google.php';">
                    <img src="img/google-icon.png" alt="Google"> Entrar com Google
                </button>
            </div>
            <div class="extra-links">
                <a href="esqueci-senha.php">Esqueci minha senha</a>
                <span>|</span>
                <a href="cadastroCliente.php">Criar nova conta</a>
            </div>
        </form>

        <!-- Mensagem de erro -->
        <?php if (!empty($mensagemErro)): ?>
            <div class="message"><?php echo htmlspecialchars($mensagemErro); ?></div>
        <?php endif; ?>
    </div>

    <!-- Inclui o rodapé -->
    <?php include 'inc/footer.php'; ?>
</div>
