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

// Verifica se o ID do prestador foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idPrestador"])) {
    $idPrestador = intval($_POST["idPrestador"]);
    $prestadorDetalhes = $cliente->buscarDetalhesPrestador($idPrestador);

    if (!$prestadorDetalhes) {
        echo "<p>Prestador não encontrado.</p>";
        exit;
    }
} else {
    header("Location: dashboardCliente.php");
    exit;
}

// Exibição de mensagem de sucesso na avaliação
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo "<div class='alert alert-success'>Obrigado por sua avaliação!</div>";
}
?>

<link rel="stylesheet" href="css/style-contatarPrestador.css">

<div class="dashboard-container">
    <div class="content">
        <div class="header">
            <h1>Detalhes do Prestador</h1>
        </div>

        <div class="prestador-detalhes">
            <div class="prestador-info">
                <img src="img/<?php echo !empty($prestadorDetalhes['foto_perfil']) ? htmlspecialchars($prestadorDetalhes['foto_perfil']) : 'avatar.png'; ?>" alt="Avatar do Prestador" class="prestador-avatar">
                <h2><?php echo htmlspecialchars($prestadorDetalhes['nome'] . ' ' . $prestadorDetalhes['sobrenome']); ?></h2>
                <p><strong>Especialidade:</strong> <?php echo htmlspecialchars($prestadorDetalhes['especialidade']); ?></p>
            </div>

            <div class="contact-button">
                <a href="https://wa.me/<?php echo htmlspecialchars($prestadorDetalhes['telefone']); ?>?text=Olá,%20gostaria%20de%20entrar%20em%20contato%20com%20você!" 
                   class="btn btn-success" target="_blank">
                   Contatar no WhatsApp
                </a>
            </div>
        </div>

        <!-- Formulário de Avaliação -->
        <div class="avaliacao">
            <h3>Deixe sua Avaliação</h3>
            <form method="POST" action="salvarAvaliacao.php">
                <input type="hidden" name="idCliente" value="<?php echo htmlspecialchars($_SESSION['logado']); ?>">
                <input type="hidden" name="idPrestador" value="<?php echo htmlspecialchars($idPrestador); ?>">
                <label for="nota">Nota:</label>
                <select name="nota" id="nota" required>
                    <option value="1">1 estrela</option>
                    <option value="2">2 estrelas</option>
                    <option value="3">3 estrelas</option>
                    <option value="4">4 estrelas</option>
                    <option value="5">5 estrelas</option>
                </select>
                <label for="comentario">Comentário:</label>
                <textarea name="comentario" id="comentario" rows="4" required></textarea>
                <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
            </form>
        </div>

        <div class="back-button">
            <a href="dashboardCliente.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
