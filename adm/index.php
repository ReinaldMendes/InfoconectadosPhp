<?php
include 'inc/header.inc.php';
?>
<style>
  body {
    background-color: black;
    background-image: url('img/logo.png'); /* substitua 'caminho/para/sua/imagem.jpg' pelo caminho correto para sua imagem */
    background-size: small; /* garante que a imagem cubra todo o fundo */
    background-position: center; /* centraliza a imagem no fundo */
    background-repeat: no-repeat; /* evita repetição da imagem */
    color: white; /* define a cor do texto como branca para melhor legibilidade */
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
  }

  .loll-image {
    display: block; /* Garante que a imagem será tratada como um bloco */
    margin: 0 auto; /* Centraliza a imagem na horizontal */
  }

  .container-fluid {
    padding-top: 50px; /* Ajuste para afastar o conteúdo do topo, para que não fique escondido pela imagem de fundo */
  }
</style>
<h2>Login</h2>

<form method="post" action="login.php">
    <div>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button><a href="index.php">Entrar</a></button>
        
    </div>
</form>


<?php
include 'inc/footer.inc.php';
?>
   