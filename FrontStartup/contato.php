<?php
session_start();
require_once 'inc/header.php'; // Inclui o cabeçalho (ajuste conforme necessário)

if (!isset($_SESSION["logado"])) {
    header("Location: login-prestador.php");
    exit;
}

$mensagemEnviada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    // Validação dos campos
    if (empty($nome)) {
        $mensagemEnviada = 'Por favor, preencha seu nome';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagemEnviada = 'Por favor, insira um email válido';
    } elseif (empty($mensagem)) {
        $mensagemEnviada = 'Por favor, escreva uma mensagem';
    } else {
        // Inicializa o EmailJS
        $serviceId = 'service_2mlvym3';  // Substitua pelo seu SERVICE_ID
        $templateId = 'template_nwmvuvi'; // Substitua pelo seu TEMPLATE_ID

        // Dados para enviar o email
        $emailData = [
            'from_name' => $nome,
            'from_email' => $email,
            'to_name' => 'Reinald', // Destinatário
            'subject' => 'Dúvida: ' . $assunto,
            'message' => $mensagem,
            // reply_to pode ser o mesmo e-mail ou outro, caso necessário
            'reply_to' => $email // Para responder ao mesmo e-mail
        ];

        // Configuração para enviar email via EmailJS
        $url = 'https://api.emailjs.com/api/v1.0/email/send';
        $data = [
            'service_id' => $serviceId,
            'template_id' => $templateId,
            'template_params' => $emailData
        ];

        // Usando cURL para enviar a requisição POST
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($result) {
            $mensagemEnviada = 'Sua mensagem foi enviada com sucesso!';
        } else {
            $mensagemEnviada = 'Ocorreu um erro ao enviar a mensagem. Tente novamente. Erro: ' . $error;
        }
    }
}
?>

<link rel="stylesheet" href="css/styleMenus.css">

<div class="page-container">
    <h1>Contato e Ajuda</h1>
    <p>Se precisar de ajuda, envie uma mensagem para nossa equipe de suporte.</p>

    <form method="POST" class="contact-form">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>

        <label>Assunto:</label>
        <input type="text" name="assunto" value="<?php echo isset($assunto) ? $assunto : ''; ?>" required>

        <label>Mensagem:</label>
        <textarea name="mensagem" required><?php echo isset($mensagem) ? $mensagem : ''; ?></textarea>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php if (!empty($mensagemEnviada)): ?>
        <p class="success-message"><?php echo $mensagemEnviada; ?></p>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>
