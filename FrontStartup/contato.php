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
    $email = $_POST['email'];

    // Configurações do e-mail
    $to = 'reinald_30_2009@hotmail.com'; // Seu e-mail
    $subject = 'Dúvida de ' . $assunto; // Assunto do e-mail
    $body = "Mensagem de: $email\n\n$mensagem"; // Corpo do e-mail
    $headers = "From: $email\r\n"; // Cabeçalho com o e-mail do usuário

    // Enviar e-mail
    if (mail($to, $subject, $body, $headers)) {
        $mensagemEnviada = 'Sua mensagem foi enviada com sucesso!';
    } else {
        $mensagemEnviada = 'Ocorreu um erro ao enviar a mensagem. Tente novamente.';
    }
}
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <h1>Contato e Ajuda</h1>
    <p>Se precisar de ajuda, envie uma mensagem para nossa equipe de suporte.</p>
    
    <form method="POST" class="contact-form">
        <label>Email:</label>
        <input type="email" name="email" required>
        
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
