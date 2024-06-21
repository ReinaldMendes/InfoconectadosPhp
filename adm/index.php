<?php
session_start(); 
require_once 'inc/headerLogin.inc.php';
require 'classes/users.class.php';

if(!empty($_POST ['email'])){
    $email = addslashes($_POST ['email']);
    $senha = md5($_POST['senha']);

    $users = new Users ();

    if($users->fazerLogin($email,$senha)){
        header("Location: login.php");
        exit;
    }else{
        echo '<span style="color: green">'."Usuário e/ou senha incorretos!".'</span>';
    }

}
?>
<br> <br>
<link rel="stylesheet" href="css/style-login.css">
<style>
  body {
    background-color: #ccc;
    background-image: url('img/logo.png'); /* substitua 'caminho/para/sua/imagem.jpg' pelo caminho correto para sua imagem */
    background-size: 500px 300px;; /* garante que a imagem cubra todo o fundo */
    background-position: center; /* centraliza a imagem no fundo */
    background-repeat: no-repeat; /* evita repetição da imagem */
    color: white; /* define a cor do texto como branca para melhor legibilidade */
   
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
    color:black
  }

  .loll-image {
    display: block; /* Garante que a imagem será tratada como um bloco */
    margin: 0 auto; /* Centraliza a imagem na horizontal */
  }
    
.login-container {
        max-width: 400px;
        margin:  0 auto;
        padding: 50px;
        background-color: #3a6310;
        border-radius: 8px;
        box-shadow: 0 12px 50px rgba(0, 0, 0, 0.1);
        position: center;
    }
    .login-container h1 {
        text-align: center;
    }
    .login-container form {
        margin-top: 20px;
    }
    .login-container label {
        display: block;
        margin-bottom: 5px;
    }
    .login-container input[type="text"],
    .login-container input[type="password"],
    .login-container button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .login-container button {
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }
    .login-container button:hover {
        background-color: #0056b3;
    }
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
include 'inc/footer.inc.php';
?>
