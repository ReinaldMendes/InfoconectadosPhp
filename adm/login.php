<?php
session_start(); 
require_once 'classes/users.class.php';
$users = new Users();
if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

$users->setUsers($_SESSION['logado']);
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
    <li> <button><?php if ($users->temPermissoes('super')):?> <a href="gestaoUsuario.php">Gestão de Usuário</a><?php endif;?></button> </li>
    <li> <button><?php if ($users->temPermissoes('super')):?><a href="gestaoCliente.php">Gestão de Clientes</a><?php endif;?> </button></li>
    <li><button> <?php if ($users->temPermissoes('super')):?><a href="gestaoPrestadores.php">Gestão de Prestadores</a> <?php endif;?></button></li>
    <li><button><?php if ($users->temPermissoes('super')):?> <a href="gestaoSistema.php">Gestão de Sistema</a><?php endif;?> </button></li>
  </ul>
    
  </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
   