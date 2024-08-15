<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infoconectados</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #cccc00; /* Cor do fundo semelhante à imagem */
            color: #ffffff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .logo-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .logo-container img {
            width: 100%;
            height: auto;
        }

        h1 {
            font-size: 48px;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        p.subtitle {
            font-size: 18px;
            margin-bottom: 50px;
            letter-spacing: 1px;
        }

        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-buttons a {
            color: #ffffff;
            background-color: transparent;
            border: 2px solid #cccc00; /* Cor amarela */
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-buttons a:hover {
            background-color: #cccc00;
            color: #000000;
        }

        footer {
            font-size: 14px;
            color: #cccc00;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Conteúdo Principal -->
    <div class="logo-container">
        <img src="logo.png" alt="Logo Infoconectados">
    </div>
    <h1>INFOCONECTADOS</h1>
    <p class="subtitle">CONECTADOS EM BUSCA DE SOLUÇÕES DE PROBLEMAS</p>

    <!-- Botões de Navegação -->
    <div class="nav-buttons">
        <a href="#">INÍCIO</a>
        <a href="#">SERVIÇOS</a>
        <a href="#">MISSÃO, VISÃO E VALORES</a>
        <a href="#">SOBRE</a>
        <a href="#">CONTATO</a>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; DESIGN: INFOCONECTADOS.</p>
    </footer>

</body>
</html>
