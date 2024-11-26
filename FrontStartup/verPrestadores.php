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

// Lógica de busca e listagem de prestadores
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["searchService"])) {
    $searchService = trim($_POST["searchService"]);
    $prestadoresDisponiveis = $cliente->buscarPrestadoresPorServico($searchService);
} else {
    $prestadoresDisponiveis = $cliente->listarPrestadores();
}

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
<link rel="stylesheet" href="css/style-verPrestador.css">

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
                                
                                <!-- Exibir Avaliações -->
                                <div class="avaliacoes-container">
                                    <h4>Avaliações:</h4>
                                    <ul class="avaliacoes-list">
                                        <?php 
                                            // Aqui você poderia adicionar a lógica para buscar avaliações associadas ao prestador
                                            $avaliacoes = $cliente->buscarAvaliacoesPrestador($prestador['idPrestador']);
                                            if (!empty($avaliacoes)):
                                                foreach ($avaliacoes as $avaliacao):
                                        ?>
                                            <li class="avaliacao-item">
                                                <strong><?php echo htmlspecialchars($avaliacao['nomeCliente']); ?></strong>: 
                                                <span class="rating"><?php echo str_repeat("★", $avaliacao['avaliacao']); ?></span>
                                                <p><?php echo htmlspecialchars($avaliacao['comentario']); ?></p>
                                            </li>
                                        <?php endforeach; else: ?>
                                            <li>Este prestador ainda não tem avaliações.</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <!-- Formulário de Avaliação -->
                                <div class="avaliar-prestador">
                                    <form method="POST" action="" class="d-flex flex-column">
                                        <input type="hidden" name="idPrestador" value="<?php echo $prestador['idPrestador']; ?>">
                                        <label for="avaliacao">Avalie este prestador:</label>
                                        <select name="avaliacao" id="avaliacao" class="form-control">
                                            <option value="1">1 estrela</option>
                                            <option value="2">2 estrelas</option>
                                            <option value="3">3 estrelas</option>
                                            <option value="4">4 estrelas</option>
                                            <option value="5">5 estrelas</option>
                                        </select>
                                        <textarea name="comentario" placeholder="Escreva seu comentário..." class="form-control" required></textarea>
                                        <button type="submit" class="btn btn-success">Enviar Avaliação</button>
                                    </form>
                                </div>

                                <form method="POST" action="contatarPrestador.php" class="contact-form">
                                    <input type="hidden" name="idPrestador" value="<?php echo $prestador['idPrestador']; ?>">
                                    <button type="submit" class="btn btn-primary">Entrar em Contato</button>
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
