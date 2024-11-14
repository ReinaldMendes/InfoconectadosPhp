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

$clientesDisponiveis = $prestador->listarClientesDisponiveis($idPrestador);
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <h1>Clientes Disponíveis</h1>
    <div class="client-list-container">
        <?php if (!empty($clientesDisponiveis)): ?>
            <ul class="client-list">
                <?php foreach ($clientesDisponiveis as $cliente): ?>
                    <li class="client-item">
                        <img src="img/<?php echo !empty($cliente['foto']) ? htmlspecialchars($cliente['foto']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="client-avatar">
                        <div>
                            <h3><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></h3>
                            <p>Serviço Necessário: <?php echo htmlspecialchars($cliente['qualServicoNecessita']); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum cliente disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
