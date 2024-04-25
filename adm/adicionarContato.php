

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
</style> //idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
<h1>Cadastrar Usuario</h1>
 <form method="POST" action="adicionarContatoSubmit.php">
    Nome: <br>
    <input type="text" name="nome"/><br><br>
    Email: <br>
    <input type="text" name="email"/><br><br>
    senha: <br>
    <input type="text" name="senha"/><br><br>
    detalhesDoPerfil: <br>
    <input type="text" name="detalhesDoPerfil"/><br><br>
    cpf: <br>
    <input type="text" name="cpf"/><br><br>
    Data_Nasc: <br>
    <input type="text" name="Data_Nasc"/><br><br>
    telefone: <br>
    <input type="text" name="telefone"/><br><br>
    
    <input type="submit" name="btCadastrar" value="ADICIONAR"/>
 </form>
 
 <?php
include 'inc/footer.inc.php';
?>