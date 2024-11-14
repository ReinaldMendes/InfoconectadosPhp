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

        // Captura os dados do formulário com sanitização
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];

        // Executa o login e captura o resultado
        ob_start(); // Inicia o buffer para capturar a saída do método
        $resultadoLogin = $cliente->fazerLogin($email, $senha);
        ob_end_clean(); // Limpa o buffer

        // Verifica o resultado do login e define a sessão
        if ($resultadoLogin) {
            // Define as informações de sessão para o cliente
            $_SESSION['tipo_usuario'] = 'cliente'; // Define como cliente
            $_SESSION['usuario_id'] = $resultadoLogin['id']; // Armazena o ID do cliente retornado pelo método

            // Redireciona para o dashboard do cliente
            header("Location: dashboardCliente.php");
            exit;
        } else {
            $mensagemErro = 'Credenciais inválidas.'; // Mensagem de erro genérica
        }
    } else {
        $mensagemErro = 'Por favor, preencha todos os campos.';
    }
}
?>

<!-- Estilo específico da página de login -->
<link rel="stylesheet" href="css/style-login.css">

<!-- Wrapper principal para flexbox -->
<div class="page-wrapper">
    <div class="wrapper">
        <div class="login-container">
            <h1>Login do Cliente</h1>

            <!-- Formulário de login -->
            <form method="POST">
                <div class="input-group">
                    <label for="email">Usuário:</label>
                    <input type="text" name="email" placeholder="Digite seu email" required>
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
                    <a href="cadastrarCliente.php">Criar nova conta</a>
                </div>
            </form>

            <!-- Mensagem de erro -->
            <?php if (!empty($mensagemErro)): ?>
                <div class="message"><?php echo htmlspecialchars($mensagemErro); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Inclui o rodapé -->
    <?php include 'inc/footer.php'; ?>
</div>
