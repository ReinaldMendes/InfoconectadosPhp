<?php
session_start(); 
include 'classes/users.class.php';
$users = new Users();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $users->excluir($id);
    header("Location: /InfoconectadosPhp/adm/gestaoUsuario.php");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /infoconectadosPhp/gestaoUsuario.php");
}