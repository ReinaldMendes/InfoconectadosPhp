<?php
include 'inc/header.inc.php';
?>

<style>
  body {
    background-color: #ccc;
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

<h1>Infoconectados Admin</h1>

<br><br>
<div class="container-fluid">
  <div class="jumbotron"> 
    <h1> SEJA BEM VINDO A PARTE ADMINISTRATIVA </h1>
    <h1> ESCOLHA UMA DAS OPÇÕES </h1>
</div>
    <button><a href="adicionarContato.php">Cadastrar Usuário</a></button>
    <button><a href="cadastroTela.php">Editar Usuario</a></button>
  <ul>
  <li><a href="#">Gestão de Área</a> </li>
  <li><a href="#">Gestão de Sub-Área</a> </li>
  <li><a href="#">Gestão de Usuário</a> </li>
  <li><a href="#">Gestão de Conteúdos</a> </li>
  </ul>
    
  </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
   