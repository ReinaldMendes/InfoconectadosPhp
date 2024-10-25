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
$clientesRecentes = $prestador->listarClientesRecentes($idPrestador); // Implementar esta função
?>

<!-- Estilo específico para o dashboard -->
<link rel="stylesheet" href="css/style-dashboard.css">

<div class="dashboard-container">
    <div class="header">
        <h1>Bem-vindo, Prestador!</h1>
        <!-- Botão de Logout -->
        <form method="POST" action="logout.php" style="margin-bottom: 20px;">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <!-- Barra de pesquisa (com margem adicional) -->
    <div class="search-container" style="margin-top: 20px;">
        <input type="text" id="search" placeholder="Buscar clientes por categoria...">
        <button type="button">Buscar</button>
    </div>

    <h2>Clientes Recentes</h2>
    <div class="slideshow-container">
        <?php foreach ($clientesRecentes as $cliente): ?>
            <div class="mySlides">
                <img src="img/<?php echo htmlspecialchars($cliente['foto']); ?>" alt="Avatar do Cliente">
                <div class="text"><?php echo htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Clientes Disponíveis</h2>
    <div class="client-list-container">
        <?php if (!empty($clientesDisponiveis)): ?>
            <ul class="client-list">
                <?php foreach ($clientesDisponiveis as $cliente): ?>
                    <li class="client-item">
                        <div class="client-info">
                            <img src="img/<?php echo !empty($cliente['foto']) ? htmlspecialchars($cliente['foto']) : 'avatar.png'; ?>" alt="Avatar do Cliente" class="client-avatar">
                            <div>
                                <h3><?php echo htmlspecialchars($cliente['nome']); ?> <?php echo htmlspecialchars($cliente['sobrenome']); ?></h3>
                                <p>Serviço Necessário: <?php echo htmlspecialchars($cliente['qualServicoNecessita']); ?></p>
                            </div>
                        </div>
                        <form method="POST" action="contatarCliente.php">
                            <input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente']; ?>">
                            <button type="submit">Entrar em Contato</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum cliente disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Inclui o rodapé -->
<?php include 'inc/footer.php'; ?>

<!-- Script do slideshow -->
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; // Esconde todos os slides
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 } // Reseta o índice se exceder o número de slides
        slides[slideIndex - 1].style.display = "block"; // Mostra o slide atual
        setTimeout(showSlides, 3000); // Muda de slide a cada 3 segundos
    }
</script>
