<?php
include 'classes/clients.class.php';
$cliente = new Cliente();

if(!empty($_GET['idCliente'])){
    $idCliente = $_GET['idCliente'];
    $cliente->excluir($idCliente);
    header("Location: /InfoconectadosPhp/adm/gestaoCliente.php");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /infoconectadosPhp/gestaoContatos.php");
}