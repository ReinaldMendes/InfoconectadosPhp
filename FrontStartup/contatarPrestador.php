<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/cliente.php';

// Verificação de Sessão
if (!isset($_SESSION["logado"])) {
    header("Location: login-cliente.php");
    exit;
}

$cliente = new Cliente();

// Verifica se o ID do prestador foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idPrestador"])) {
    $idPrestador = intval($_POST["idPrestador"]);
    $prestadorDetalhes = $cliente->buscarDetalhesPrestador($idPrestador);

    if (!$prestadorDetalhes) {
        echo "<p>Prestador não encontrado.</p>";
        exit;
    }
} else {
    header("Location: dashboardCliente.php");
    exit;
}
?>

<link rel="stylesheet" href="css/style-contatarPrestador.css">

<div class="dashboard-container">
    <div class="content">
        <div class="header">
            <h1>Detalhes do Prestador</h1>
        </div>

        <div class="prestador-detalhes">
            <div class="prestador-info">
                <img src="img/<?php echo !empty($prestadorDetalhes['foto_perfil']) ? htmlspecialchars($prestadorDetalhes['foto_perfil']) : 'avatar.png'; ?>" alt="Avatar do Prestador" class="prestador-avatar">
                <h2><?php echo htmlspecialchars($prestadorDetalhes['nome'] . ' ' . $prestadorDetalhes['sobrenome']); ?></h2>
                <p><strong>Especialidade:</strong> <?php echo htmlspecialchars($prestadorDetalhes['especialidade']); ?></p>
                
            </div>

            <div class="contact-button">
                <a href="https://wa.me/<?php echo htmlspecialchars($prestadorDetalhes['telefone']); ?>?text=Olá,%20gostaria%20de%20entrar%20em%20contato%20com%20você!" 
                   class="btn btn-success" target="_blank">
                   Contatar no WhatsApp
                </a>
            </div>
        </div>

        <div class="back-button">
            <a href="dashboardCliente.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>