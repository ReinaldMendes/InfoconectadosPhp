<?php require_once 'inc/header.php'; ?>
<link rel="stylesheet" href="css/style-contato.css">

<section class="hero">
<div class="container">
<h2>Entre em Contato Conosco</h2>
<p>Este é o formulário para entrar em contato conosco. Preencha os campos abaixo com as informações solicitadas, e nossa equipe responderá o mais breve possível. Fique à vontade para enviar dúvidas ou sugestões!</p>
    <form id="contactForm">
        <label for="user_name">Seu Nome:</label>
        <input type="text" id="user_name" name="user_name" placeholder="Seu Nome" required>
        
        <label for="user_email">Seu Email:</label>
        <input type="email" id="user_email" name="user_email" placeholder="Seu Email" required>
        
        <label for="message">Mensagem:</label>
        <textarea id="message" name="message" placeholder="Sua Mensagem" rows="5" required></textarea>
        
        <button type="submit">Enviar</button>
    </form>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
    // Inicialize o EmailJS
    emailjs.init("FPVo19JAnr2DUL18r");

    // Adicione o evento ao formulário
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Obtenha os dados do formulário
        const templateParams = {
            to_name: "Reinald",
            from_name: document.getElementById('user_name').value,
            message: document.getElementById('message').value,
            reply_to: document.getElementById('user_email').value
        };

        // Envio do email
        emailjs.send("service_2mlvym3", "template_nwmvuvi", templateParams)
            .then(function(response) {
                alert('Email enviado com sucesso! Obrigado pelo contato.');
                document.getElementById('contactForm').reset();
            }, function(error) {
                alert('Erro ao enviar o email. Por favor, tente novamente.');
                console.error('Erro:', error);
            });
    });
</script>


<?php require_once 'inc/footer.php'; ?>