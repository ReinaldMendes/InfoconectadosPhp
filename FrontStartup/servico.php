<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infoconectados - Serviços</title>
    <link rel="stylesheet" href="./css/style-index.css">
</head>
<body>

    <!-- Incluindo o cabeçalho -->
    <?php include 'inc/header.php'; ?>

    <!-- Seção de Serviços com imagem de fundo como na index -->
    <section class="hero">
        <div class="content">
            <h1>Conectando Clientes e Profissionais</h1>
            <p class="subtitle">ESCOLHA A OPÇÃO QUE MELHOR ATENDE AS SUAS NECESSIDADES.</p>

            <!-- Seção de Serviços -->
            <div class="services-container">
                <div class="service-card">
                    <img src="img/cliente.png" alt="Sou Cliente">
                    <h3>Sou Cliente</h3>
                    <p>Preciso de um serviço.</p>
                    <a href="#">Ver Mais</a>
                </div>
                <div class="service-card">
                    <img src="img/profissional.png" alt="Sou Profissional">
                    <h3>Sou Profissional</h3>
                    <p>Busco novos clientes.</p>
                    <a href="#">Ver Mais</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Incluindo o rodapé -->
    <?php include 'inc/footer.php'; ?>

</body>
</html>
