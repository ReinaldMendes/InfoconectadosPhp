<?php
  include 'classes/prestadores.class.php';
  $prestador = new Prestador();
if(!empty($_POST['idPrestador'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $endereco = $_POST['endereco'];
    $data_nasc = $_POST['data_nasc'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $idPrestador = $_POST['idPrestador'];
    if(!empty($email)){
        $prestador->editar( $nome,,$sobrenome,$endereco,$data_nasc, $cpf, $telefone, $email, $senha, $idPrestador);
    }

    header('Location: gestaoPrestadores.php');

}

?>

 