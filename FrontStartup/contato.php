<?php
session_start();
require_once 'inc/header.php';

if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

$mensagemEnviada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];
    // Implementar lógica para enviar a mensagem ao suporte (ex.: salvar em banco de dados ou enviar por email)
    $mensagemEnviada = 'Sua mensagem foi enviada com sucesso!';
}
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <h1>Contato e Ajuda</h1>
    <p>Se precisar de ajuda, envie uma mensagem para nossa equipe de suporte.</p>
    
    <form method="POST" class="contact-form">
        <label>Assunto:</label>
        <input type="text" name="assunto" required>
        
        <label>Mensagem:</label>
        <textarea name="mensagem" required></textarea>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    
    <?php if (!empty($mensagemEnviada)): ?>
        <p class="success-message"><?php echo $mensagemEnviada; ?></p>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>
