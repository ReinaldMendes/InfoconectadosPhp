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
$idCliente = $_SESSION["logado"];

// Lógica de busca e listagem
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["searchService"])) {
    $searchService = trim($_POST["searchService"]);
    $prestadoresDisponiveis = $cliente->buscarPrestadoresPorServico($searchService);
} else {
    $prestadoresDisponiveis = $cliente->listarPrestadores();
}

$prestadoresRecentes = $cliente->listarPrestadores();

// Processar avaliação
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["avaliacao"])) {
    $idPrestador = $_POST["idPrestador"];
    $avaliacao = $_POST["avaliacao"];
    $comentario = trim($_POST["comentario"]);
    $cliente->avaliarPrestador($idCliente, $idPrestador, $avaliacao, $comentario);
    echo "<script>alert('Avaliação enviada com sucesso!');</script>";
    // Atualizar a lista de prestadores para refletir a avaliação
    $prestadoresDisponiveis = $cliente->listarPrestadores();
}
?>
<link rel="stylesheet" href="css/style-dashboard.css">

<div class="dashboard-container d-flex">
    <!-- Menu Lateral -->
    <nav class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="verPrestadores.php">Prestadores</a></li>
            <li><a href="historicoServicos.php">Serviços</a></li>
            <li><a href="perfilCliente.php">Perfil</a></li>
            <li><a href="contato.php">Ajuda</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        <div class="header d-flex justify-content-between align-items-center">
            <h1>Bem-vindo, Cliente!</h1>
        </div>

        <!-- Barra de pesquisa -->
        <div class="search-container">
            <form method="POST" action="" class="d-flex">
                <input type="text" name="searchService" id="search" placeholder="Buscar prestadores por serviço..." class="form-control">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>

        <h2>Prestadores Recentes</h2>
        <div class="slideshow-container">
            <?php foreach ($prestadoresRecentes as $prestador): ?>
                <div class="mySlides">
                <img src="img/<?php echo !empty($prestador['foto']) ? htmlspecialchars($prestador['foto']) : 'avatar.png'; ?>" alt="Avatar do Prestador" class="client-image">

                    <div class="text"><?php echo htmlspecialchars($prestador['nome'] . ' ' . $prestador['sobrenome']); ?></div>
                </div>
            <?php endforeach; ?>
            <div class="slideshow-indicators">
                <?php foreach ($prestadoresRecentes as $index => $prestador): ?>
                    <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span>
                <?php endforeach; ?>
            </div>
        </div>

        <h2>Prestadores Disponíveis</h2>
        <div class="client-list-container">
            <div class="container">
                <?php if (!empty($prestadoresDisponiveis)): ?>
                    <ul class="client-list">
                        <?php foreach ($prestadoresDisponiveis as $prestador): ?>
                            <li class="client-item">
                                <div class="client-info d-flex align-items-center">
                                    <img src="img/<?php echo !empty($prestador['foto']) ? htmlspecialchars($prestador['foto']) : 'avatar.png'; ?>" alt="Avatar do Prestador" class="client-avatar">
                                    <div>
                                        <h3><?php echo htmlspecialchars($prestador['nome'] . ' ' . $prestador['sobrenome']); ?></h3>
                                        <p>Especialidade: <?php echo htmlspecialchars($prestador['especialidade']); ?></p>
                                    </div>
                                </div>
                                <form method="POST" action="contatarPrestador.php" class="contact-form">
                                    <input type="hidden" name="idPrestador" value="<?php echo $prestador['idPrestador']; ?>">
                                    <button type="submit" class="btn btn-success">Entrar em Contato</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Nenhum prestador disponível no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Script do slideshow -->
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        const slides = document.getElementsByClassName("mySlides");
        const dots = document.getElementsByClassName("dot");
        if (n > slides.length) { slideIndex = 1; }
        if (n < 1) { slideIndex = slides.length; }
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>

