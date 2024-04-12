<?php
include 'inc/header.inc.php';
?>
<style>
body {
    background-color: #ccc;
    
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
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
   