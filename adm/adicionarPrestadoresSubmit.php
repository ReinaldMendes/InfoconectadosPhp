<?php
require_once 'classes/prestadores.class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $prestador = new Prestador();
    $prestador->adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email);

    header("Location: gestaoPrestadores.php");
    exit;
} else {
    echo "Erro ao processar requisição.";
}
?>
