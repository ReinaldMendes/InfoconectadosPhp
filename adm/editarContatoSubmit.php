<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
if(!empty($_POST['idUsuario'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $detalhesDoPerfil = $_POST['detalhesDoPerfil'];
    $rua = $_POST['cpf'];
    $numero = $_POST['Data_Nasc'];
    $bairro = $_POST['telefone'];
    $id = $_POST['idUsuario'];
    if(!empty($email)){
        $contato->editar( $nome, $email, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone, $idUsuario);
    }

    header('Location: cadastroTela.php');

}

?>