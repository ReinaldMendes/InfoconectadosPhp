<?php
session_start(); 
require_once 'classes/users.class.php';
$users = new Users();
if(!isset($_SESSION['logado'])){
    header("Location: index.php");
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
    color: #355E3B;
}
</style>
<h1>Infoconectados</h1>

<br><br>
<div class="container-fluid">
  <div class="jumbotron"> 
    <h1> SEJA BEM VINDO <?php echo $_SESSION['logado']; ?>, À PARTE ADMINISTRATIVA </h1>
    <h1> ESCOLHA UMA DAS OPÇÕES </h1>
  </div>
  <ul>
    <li> <button><?php if ($users->temPermissoes('super') || $users->temPermissoes('add') ):?> <a class="btn btn-primary" href="gestaoUsuario.php">Gestão de Usuário</a><?php endif;?></button> </li><br>
    <li> <button><?php if ($users->temPermissoes('super')):?><a class="btn btn-primary" href="gestaoCliente.php">Gestão de Clientes</a><?php endif;?> </button></li><br>
    <li><button> <?php if ($users->temPermissoes('super')):?><a class="btn btn-primary" href="gestaoPrestadores.php">Gestão de Prestadores</a> <?php endif;?></button></li><br>
    <li><button><?php if ($users->temPermissoes('super')):?> <a class="btn btn-primary" href="gestaoSistema.php">Gestão de Sistema</a><?php endif;?> </button></li><br>
  </ul>
    </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
