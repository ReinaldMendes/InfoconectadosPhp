<?php
  include 'classes/clients.class.php';
  $cliente = new Cliente();
if(!empty($_POST['idCliente'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $detalhesDoPerfil = $_POST['detalhesDoPerfil'];
    $cpf = $_POST['cpf'];
    $numero = $_POST['Data_Nasc'];
    $telefone = $_POST['telefone'];
    $idCliente = $_POST['idCliente'];
    if(!empty($email)){
        $contato->editar( $nome, $email, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone, $idCliente);
    }

    header('Location: gestaoUsuario.php');

}

?>

 