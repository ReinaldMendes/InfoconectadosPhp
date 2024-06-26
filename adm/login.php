<?php
session_start(); 
require_once 'classes/users.class.php';
$users = new Users();
if(!isset($_SESSION['logado'])){
    header("Location: index.php");
    exit;
}

$users->setUsers($_SESSION['logado']);
$nomeUsuario = $users->getNomeUsuario(); // Obtendo o nome do usuário logado

include 'inc/header.inc.php';
?>

    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/styleLogin.css">
 
  
<body>
    <div class="container">
        <div class="jumbotron mt-5">
            <h1>SEJA BEM VINDO, <?php echo htmlspecialchars($nomeUsuario); ?> :) <br> ESSA É A GESTÃO ADMINISTRATIVA </h1>
            <h4>ESCOLHA UMA DAS OPÇÕES : </h4>
        </div>
        <div class="options">
            <ul>
                <li>
                    <?php if ($users->temPermissoes('super') || $users->temPermissoes('add')): ?>
                        <a class="btn btn-custom btn-lg" href="gestaoUsuario.php">Gestão de Usuário</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($users->temPermissoes('super') || $users->temPermissoes('add')): ?>
                        <a class="btn btn-custom btn-lg" href="gestaoCliente.php">Gestão de Clientes</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($users->temPermissoes('super') || $users->temPermissoes('add')): ?>
                        <a class="btn btn-custom btn-lg" href="gestaoPrestadores.php">Gestão de Prestadores</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($users->temPermissoes('super')): ?>
                        <a class="btn btn-custom btn-lg" href="gestaoSistema.php">Gestão de Sistema</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script> <!-- Link local para o jQuery -->
    <script src="js/bootstrap.min.js"></script> <!-- Link local para o JS do Bootstrap -->
</body>
</html>
<link rel="stylesheet" href="css/style-gestao.css">
<?php
include 'inc/footer.inc.php';
?>
