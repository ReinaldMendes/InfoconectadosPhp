<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/prestadores.php';

// Verifica se o prestador está logado
if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

// Instancia a classe Prestador e obtém os dados do prestador logado
$prestador = new Prestador();
$idPrestador = $_SESSION["logado"];
$dadosPrestador = $prestador->obterDadosPrestador($idPrestador);

// Verifica se o formulário foi submetido via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $nova_senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : null;

    // Atualiza o perfil, incluindo a senha se for fornecida
    $prestador->atualizarPerfil($idPrestador, $nome, $sobrenome, $email, $telefone, $endereco, $nova_senha);
    
    // Mensagem de sucesso
    $_SESSION['msg'] = "Alterações salvas com sucesso!";
    
    header("Location: perfilPrestador.php");
    exit;
}
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="dashboardPrestador.php">Voltar ao Dasboard</a></li>
            <li><a href="ver-clientes.php">Ver Clientes</a></li>
            <li><a href="historico-servicos.php">Histórico de Serviços</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </div>

    <!-- Conteúdo principal -->
    <div class="page-content">
        <h1>Perfil do Prestador</h1>
        
        <?php
        // Exibe mensagem de sucesso, se disponível
        if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);  // Remove a mensagem após exibição
        }
        ?>

        <div class="profile-container">
            <div class="profile-header">
                <!-- Foto de perfil ou avatar padrão -->
                <div class="profile-image">
                    <?php
                    // Verifica se o prestador tem uma foto de perfil
                    $fotoPerfil = $dadosPrestador['foto_perfil'] ? $dadosPrestador['foto_perfil'] : 'img/avatar.png';  // Certifique-se de que o caminho esteja correto
                    echo "<img src='$fotoPerfil' alt='Foto do Prestador' class='profile-avatar'>";  // Ajuste no caminho da imagem
                    ?>
                </div>

                <div class="profile-info">
                    <h2><?php echo htmlspecialchars($dadosPrestador['nome']) . ' ' . htmlspecialchars($dadosPrestador['sobrenome']); ?></h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($dadosPrestador['email']); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($dadosPrestador['telefone']); ?></p>
                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($dadosPrestador['endereco']); ?></p>
                </div>
            </div>

            <!-- Formulário de atualização do perfil -->
            <form method="POST" class="profile-form">
                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($dadosPrestador['nome']); ?>" required>

                <label>Sobrenome:</label>
                <input type="text" name="sobrenome" value="<?php echo htmlspecialchars($dadosPrestador['sobrenome']); ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($dadosPrestador['email']); ?>" required>

                <label>Telefone:</label>
                <input type="text" name="telefone" value="<?php echo htmlspecialchars($dadosPrestador['telefone']); ?>" required>

                <label>Endereço:</label>
                <input type="text" name="endereco" value="<?php echo htmlspecialchars($dadosPrestador['endereco']); ?>" required>

                <label>Nova Senha (opcional):</label>
                <input type="password" name="nova_senha" placeholder="Digite sua nova senha (se desejar alterá-la)">

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
