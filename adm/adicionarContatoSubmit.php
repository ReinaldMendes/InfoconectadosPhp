<?php

include 'classes/contatos.class.php';
$contato = new Contatos(); //idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $detalhesDoPerfil = $_POST['detalhesDoPerfil'];
    $cpf = $_POST['cpf'];
    $Data_Nasc = $_POST['Data_Nasc'];
    $telefone= $_POST['telefone'];


    $contato->adicionar($email, $nome, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone);
    header('Location: cadastroTela.php');

}else{
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
?>

