<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/prestadores.php';

if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

$prestador = new Prestador();
$idPrestador = $_SESSION["logado"];
$dadosPrestador = $prestador->obterDadosPrestador($idPrestador);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token inválido.");
    }

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $especialidade = $_POST['especialidade'];
    $nova_senha = $_POST['nova_senha'] ?? null;

    if (empty($nome) || empty($sobrenome) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = "Por favor, preencha todos os campos corretamente!";
        header("Location: perfilPrestador.php");
        exit;
    }

    $prestador->atualizarPerfil($idPrestador, $nome, $sobrenome, $email, $telefone, $endereco, $nova_senha, $especialidade);
    $_SESSION['msg'] = "Alterações salvas com sucesso!";
    header("Location: perfilPrestador.php");
    exit;
}

$mensagem = $_SESSION['msg'] ?? null;
unset($_SESSION['msg']);

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="dashboardPrestador.php">Voltar ao Dasboard</a></li>
            <li><a href="verClientes.php">Ver Clientes</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </div>

    <div class="page-content">
        <h1>Perfil do Prestador</h1>

        <?php if ($mensagem): ?>
            <div class='alert alert-success'><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-image">
                    <?php
                    $fotoPerfil = htmlspecialchars($dadosPrestador['foto_perfil'] ?? 'img/avatar.png');
                    echo "<img src='$fotoPerfil' alt='Foto do Prestador' class='profile-avatar'>";
                    ?>
                </div>

                <div class="profile-info">
                    <h2><?php echo htmlspecialchars($dadosPrestador['nome']) . ' ' . htmlspecialchars($dadosPrestador['sobrenome']); ?></h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($dadosPrestador['email']); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($dadosPrestador['telefone']); ?></p>
                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($dadosPrestador['endereco']); ?></p>
                    <p><strong>Especialidade:</strong> <?php echo htmlspecialchars($dadosPrestador['especialidade']); ?></p>
                </div>
            </div>

            <form method="POST" class="profile-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
                <label>Especialidade:</label>
                <input type="text" name="especialidade" value="<?php echo htmlspecialchars($dadosPrestador['especialidade']); ?>" required>
                <label>Nova Senha (opcional):</label>
                <input type="password" name="nova_senha" placeholder="Digite sua nova senha (se desejar alterá-la)">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
