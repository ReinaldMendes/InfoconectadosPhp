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

<link rel="stylesheet" href="css/style-pag.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<br> <br>
<div class="dashboard-container d-flex">
    <!-- Menu Lateral -->
    <nav class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="dashboardPrestador.php">Voltar ao Dashboard</a></li>
            <li><a href="perfilPrestador.php">Perfil</a></li>
            <li><a href="contato.php">Ajuda</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

<div class="page-container">
    <h1>Clientes Disponíveis</h1>
    <div class="client-carousel">
        <?php if (!empty($clientesDisponiveis)): ?>
            <?php foreach ($clientesDisponiveis as $cliente): ?>
                <div class="client-item">
                    <a href="detalhesCliente.php?id=<?php echo htmlspecialchars($cliente['idCliente']); ?>">
                        <img src="img/<?php echo !empty($cliente['foto']) ? htmlspecialchars($cliente['foto']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="client-avatar">
                        <h3><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></h3>
                        <p>Serviço Necessário: <?php echo htmlspecialchars($cliente['qualServicoNecessita']); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum cliente disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('.client-carousel').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 3000
        });
    });
</script>


