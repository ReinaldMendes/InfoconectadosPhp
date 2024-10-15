<?php
session_start(); 
require_once '../adm/inc/headerLogin.inc.php';
require '../adm/classes/prestadores.class.php';

if(!empty($_POST ['email'])){
    $email = addslashes($_POST ['email']);
    $senha = md5($_POST['senha']);

    $prestador = new Prestador();

    if($prestador->fazerLogin($email,$senha)){
        header("Location: index.php");
        exit;
    }else{
        echo '<span style="color: green">'."Usuário e/ou senha incorretos!".'</span>';
    }

}
?>


<br> <br>
<link rel="stylesheet" href="../adm/css/style-index.css">
<style>

</style>

<br> <br>

<head>
<div class="login-container">
    <h1>LOGIN</h1>

    <form method="POST">
        <div>
            <label for="email"> Usuário: </label>
            <input type="text" name="email" placeholder="Digite seu email">
        </div>
        <div>
            <label for="senha">Senha: </label>
            <input type="password"  name="senha" placeholder="Digite sua senha">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>
</div>
</head>


<?php
include '../adm/inc/footer.inc.php';
?>
