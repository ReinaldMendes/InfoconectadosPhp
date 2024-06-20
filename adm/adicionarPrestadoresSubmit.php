<?php
session_start();
include 'classes/prestadores.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); // Criptografia MD5 da senha

    $prestador = new Prestador();

    if ($prestador->adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha)) {
        header("Location: gestaoPrestadores.php");
    } else {
        echo '<script type="text/javascript">alert("Erro ao adicionar prestador.");</script>';
    }
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos.");</script>';
}
?>
