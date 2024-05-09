<?php

include 'classes/clients.class.php';
$cliente = new Cliente(); 
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $qualServicoNecessita = $_POST['qualServicoNecessita'];
    $telefone= $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    


    $cliente->adicionar( $nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha );
    header('Location: gestaoCliente.php');

}else{
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
?>

