

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
<h1>Cadastrar Usuario</h1>
 <form method="POST" action="adicionarContatoSubmit.php">
    Nome: <br>
    <input type="text" name="nome"/><br><br>
    Email: <br>
    <input type="text" name="email"/><br><br>
    Telefone: <br>
    <input type="text" name="telefone"/><br><br>
    Cidade: <br>
    <input type="text" name="cidade"/><br><br>
    Rua: <br>
    <input type="text" name="rua"/><br><br>
    Número: <br>
    <input type="text" name="numero"/><br><br>
    Bairro: <br>
    <input type="text" name="bairro"/><br><br>
    Cep: <br>
    <input type="text" name="cep"/><br><br>
    Profissão: <br>
    <input type="text" name="profissao"/><br><br>
    Foto: <br>
    <input type="text" name="foto"/><br><br>
   
    <input type="submit" name="btCadastrar" value="ADICIONAR"/>
 </form>
 
 <?php
include 'inc/footer.inc.php';
?>