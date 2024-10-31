<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/prestadores.php';

// Inicializa a mensagem de erro
$mensagemErro = '';

// Processa o formulário ao submeter os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos de email e senha estão preenchidos
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        // Instancia a classe Prestador
        $prestador = new Prestador();

        // Captura os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Executa o login e captura o resultado
        ob_start(); // Inicia o buffer para capturar a saída JSON do loginJSON()
        $prestador->loginJSON($email, $senha);
        $resultadoLogin = ob_get_clean(); // Armazena a saída em $resultadoLogin

        // Decodifica o JSON
        $dadosLogin = json_decode($resultadoLogin, true);

        // Verifica se a decodificação foi bem-sucedida
        if (is_array($dadosLogin) && isset($dadosLogin['success'])) {
            if ($dadosLogin['success']) {
                header("Location: dashboardPrestador.php"); // Redireciona para o dashboard do prestador
                exit;
            } else {
                $mensagemErro = $dadosLogin['message'];
            }
        } else {
            $mensagemErro = 'Erro ao processar a resposta do servidor.';
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
            <h1>Login do Prestador</h1>

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
                    <a href="cadastroPrestador.php">Criar nova conta</a>
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
