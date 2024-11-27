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

// Verifica se o ID do cliente foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idCliente"])) {
    $idCliente = intval($_POST["idCliente"]);
    $clienteDetalhes = $cliente->buscarDetalhesCliente($idCliente);

    if (!$clienteDetalhes) {
        echo "<p>Cliente não encontrado.</p>";
        exit;
    }
} else {
    header("Location: dashboardPrestador.php");
    exit;
}
?>

<link rel="stylesheet" href="css/style-contatarCliente.css">

<div class="dashboard-container">
    <div class="content">
        <div class="header">
            <h1>Detalhes do Cliente</h1>
        </div>

        <div class="cliente-detalhes">
            <div class="cliente-info">
                <img src="img/<?php echo !empty($clienteDetalhes['foto_perfil']) ? htmlspecialchars($clienteDetalhes['foto_perfil']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="cliente-avatar">
                <h2><?php echo htmlspecialchars($clienteDetalhes['nome'] . ' ' . $clienteDetalhes['sobrenome']); ?></h2>
                <p><strong>Serviço Necessário:</strong> <?php echo htmlspecialchars($clienteDetalhes['servicoNecessario']); ?></p>
            </div>

            <div class="contact-button">
                <a href="https://wa.me/<?php echo htmlspecialchars($clienteDetalhes['telefone']); ?>?text=Olá,%20gostaria%20de%20entrar%20em%20contato%20com%20você!" 
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
