<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_GET['idUsuario'])){
    $id = $_GET['idUsuario'];
    $contato->excluir($idUsuario);
    header("Location: cadastroTela.php");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /InfoconectadosPhp");
}