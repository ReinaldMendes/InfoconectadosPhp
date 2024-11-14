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
$historicoServicos = $prestador->listarHistoricoServicos($idPrestador);
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <h1>Histórico de Serviços</h1>
    <div class="service-history-container">
        <?php if (!empty($historicoServicos)): ?>
            <ul class="service-history-list">
                <?php foreach ($historicoServicos as $servico): ?>
                    <li class="service-item">
                        <h3><?php echo htmlspecialchars($servico['nomeCliente'] . ' ' . $servico['sobrenomeCliente']); ?></h3>
                        <p>Serviço: <?php echo htmlspecialchars($servico['servicoPrestado']); ?></p>
                        <p>Data: <?php echo htmlspecialchars($servico['dataServico']); ?></p>
                        <p>Observações: <?php echo htmlspecialchars($servico['observacoes']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Você ainda não possui histórico de serviços.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
