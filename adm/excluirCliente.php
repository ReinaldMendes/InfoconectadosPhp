<?php
include 'classes/clients.class.php';
$cliente = new Cliente();

if(!empty($_GET['idCliente'])){
    $idUsuario = $_GET['idCliente'];
    $contato->excluir($idUsuario);
    header("Location: /infoconectadosPhp/gestaoContatos.php");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /infoconectadosPhp/gestaoContatos.php");
}