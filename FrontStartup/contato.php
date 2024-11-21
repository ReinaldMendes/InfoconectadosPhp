<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script>
        (function () {
            emailjs.init("FPVo19JAnr2DUL18r"); // Public Key
        })();
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Formulário de Contato</h2>
    <form id="contact-form">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" placeholder="Digite seu nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

        <label for="message">Mensagem:</label>
        <textarea id="message" name="message" rows="4" placeholder="Digite sua mensagem" required></textarea>

        <button type="button" onclick="sendEmail()">Enviar</button>
    </form>

    <script>
        function sendEmail() {
            const serviceID = "service_2mlvym3";
            const templateID = "template_nwmvuvi";

            const templateParams = {
                name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                message: document.getElementById("message").value,
            };

            emailjs.send(serviceID, templateID, templateParams)
                .then((response) => {
                    alert("Mensagem enviada com sucesso! Código: " + response.status);
                })
                .catch((error) => {
                    alert("Erro ao enviar mensagem: " + JSON.stringify(error));
                });
        }
    </script>
</body>
</html>
