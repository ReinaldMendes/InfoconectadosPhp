<?php
session_start();
require_once 'inc/header.php';
require 'vendor/autoload.php'; // Certifique-se de que o Composer está configurado corretamente

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

$mensagemEnviada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];
    $email = $_POST['email'];

    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com'; // Substitua pelo servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'reinald.2967@aluno.pr.senac.pr'; // Seu e-mail SMTP
        $mail->Password = '08726262967'; // Sua senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Segurança TLS
        $mail->Port = 587; // Porta SMTP

        // Configurações do e-mail
        $mail->setFrom($email, 'Contato do Usuário');
        $mail->addAddress('reinald_30_2009@hotmail.com'); // Seu e-mail de destino
        $mail->Subject = 'Dúvida de ' . $assunto;
        $mail->Body = "Mensagem de: $email\n\n$mensagem";

        $mail->send();
        $mensagemEnviada = 'Sua mensagem foi enviada com sucesso!';
    } catch (Exception $e) {
        $mensagemEnviada = 'Ocorreu um erro ao enviar a mensagem. Erro: ' . $mail->ErrorInfo;
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
