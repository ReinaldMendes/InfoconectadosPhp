<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/prestadores.php';

// Verificação de Sessão
if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

$prestador = new Prestador();

// Verifica se o ID do cliente foi enviado via GET
if (isset($_GET["id"])) {
    $idCliente = intval($_GET["id"]);  // Captura o ID do cliente da URL
    $clienteDetalhes = $prestador->buscarDetalhesCliente($idCliente);

    if (!$clienteDetalhes) {
        echo "<p>Cliente não encontrado.</p>";
        exit;
    }
} else {
    header("Location: dashboardPrestador.php");
    exit;
}
?>

<link rel="stylesheet" href="css/style-contatarPrestador.css">

<div class="dashboard-container">
    <div class="content">
        <div class="header">
            <h1>Detalhes do Cliente</h1>
        </div>

        <div class="prestador-detalhes">
            <div class="prestador-info">
                <img src="img/<?php echo !empty($clienteDetalhes['foto_perfil']) ? htmlspecialchars($clienteDetalhes['foto_perfil']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="prestador-avatar">
                <h2><?php echo htmlspecialchars($clienteDetalhes['nome'] . ' ' . $clienteDetalhes['sobrenome']); ?></h2>
                <p><strong>Serviço Necessário:</strong> <?php echo htmlspecialchars($clienteDetalhes['qualServicoNecessita']); ?></p>
                <p><strong>Endereço:</strong> <?php echo htmlspecialchars($clienteDetalhes['endereco']); ?></p>
            </div>

            <div class="contact-button">
                <a href="https://wa.me/<?php echo htmlspecialchars($clienteDetalhes['telefone']); ?>?text=Olá,%20sou%20um%20prestador%20interessado%20em%20ajudar%20você!" 
                   class="btn btn-success" target="_blank">
                   Contatar no WhatsApp
                </a>
            </div>
        </div>

        <div class="back-button">
            <a href="dashboardPrestador.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
