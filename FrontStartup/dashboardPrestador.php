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
$idPrestador = $_SESSION["logado"];

// Lógica de busca e listagem
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["searchService"])) {
    $searchService = trim($_POST["searchService"]);
    $clientesDisponiveis = $prestador->buscarClientesPorServico($idPrestador, $searchService);
} else {
    $clientesDisponiveis = $prestador->listarClientesDisponiveis($idPrestador);
}

$clientesRecentes = $prestador->listarClientesRecentes($idPrestador);
?>

<link rel="stylesheet" href="css/style-dashboard.css">

<div class="dashboard-container d-flex">
    <!-- Menu Lateral -->
    <nav class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="verClientes.php">Clientes</a></li>
            <li><a href="perfilPrestador.php">Perfil</a></li>
            <li><a href="contato.php">Ajuda</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        <div class="header d-flex justify-content-between align-items-center">
            <h1>Bem-vindo, Prestador!</h1>
        </div>

        <!-- Barra de pesquisa -->
        <div class="search-container">
            <form method="POST" action="" class="d-flex">
                <input type="text" name="searchService" id="search" placeholder="Buscar clientes por servico..." class="form-control">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>

        <h2>Clientes Recentes</h2>
        <div class="slideshow-container">
            <?php foreach ($clientesRecentes as $cliente): ?>
                <div class="mySlides">
                    <img src="img/<?php echo htmlspecialchars($cliente['foto']); ?>" alt="Avatar do Cliente" class="client-image">
                    <div class="text"><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Clientes Disponíveis</h2>
        <div class="client-list-container">
            <div class="container">
                <?php if (!empty($clientesDisponiveis)): ?>
                    <ul class="client-list">
                        <?php foreach ($clientesDisponiveis as $cliente): ?>
                            <li class="client-item">
                                <div class="client-info d-flex align-items-center">
                                    <img src="img/<?php echo !empty($cliente['foto']) ? htmlspecialchars($cliente['foto']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="client-avatar">
                                    <div>
                                        <h3><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></h3>
                                        <p>Serviço Necessário: <?php echo htmlspecialchars($cliente['qualServicoNecessita']); ?></p>
                                    </div>
                                </div>
                                <form method="POST" action="contatarCliente.php">
                                    <input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente']; ?>">
                                    <button type="submit" class="btn btn-success">Entrar em Contato</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Nenhum cliente disponível no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




<!-- Script do slideshow -->
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1; }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 3000);
    }
</script>
