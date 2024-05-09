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
<ul>
    <li> <button><a href="gestaoUsuario.php">Gestão de Usuário</a></button> </li>
    <li> <button><a href="#">Gestão de Área</a> </button></li>
    <li><button> <a href="#">Gestão de Sub-Área</a> </button></li>
    <li><button><a href="#">Gestão de Conteúdos</a> </button></li>
  </ul>
    
  </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
   