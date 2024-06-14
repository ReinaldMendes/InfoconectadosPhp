<?php
  include 'classes/clients.class.php';
  $cliente = new Cliente();
if(!empty($_POST['idUsuario'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $detalhesDoPerfil = $_POST['detalhesDoPerfil'];
    $cpf = $_POST['cpf'];
    $numero = $_POST['Data_Nasc'];
    $telefone = $_POST['telefone'];
    $idUsuario = $_POST['idUsuario'];
    if(!empty($email)){
        $contato->editar( $nome, $email, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone, $idUsuario);
    }

    header('Location: gestaoUsuario.php');

}

?>

 