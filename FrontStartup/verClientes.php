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
        <p>Estes são os clientes que precisam dos seus serviços. Clique em um cliente para visualizar mais detalhes e entrar em contato. Aproveite para oferecer o melhor atendimento!</p>
        <div class="client-carousel">
            <?php if (!empty($clientesDisponiveis)): ?>
                <?php foreach ($clientesDisponiveis as $cliente): ?>
                    <div class="client-item">
                        <!-- Certifique-se de que a URL está correta -->
                        <a href="contatarCliente.php?id=<?php echo urlencode($cliente['idCliente']); ?>">
                            <img src="img/<?php echo !empty($cliente['foto_perfil']) ? htmlspecialchars($cliente['foto_perfil']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="client-avatar">
                            <h3><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></h3>
                            <p>Serviço Necessário: <?php echo htmlspecialchars($cliente['qualServicoNecessita']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No momento, não há clientes disponíveis. Volte mais tarde ou explore outras áreas do nosso dashboard.</p>
            <?php endif; ?>
        </div>
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
