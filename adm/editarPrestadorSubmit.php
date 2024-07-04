<?php
include 'classes/prestadores.class.php';

$prestador = new Prestador();

if(!empty($_POST['idPrestador'])){
    $idPrestador = $_POST['idPrestador'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $endereco = $_POST['endereco'];
    $data_nasc = $_POST['data_nasc'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o campo de senha não está vazio para atualizar
    if (!empty($senha)) {
        $senha = md5($senha);
    } else {
        // Caso a senha esteja vazia, mantenha a senha existente no banco de dados
        $currentInfo = $prestador->buscar($idPrestador);
        $senha = $currentInfo['senha'];
    }

    // Executa a edição do prestador
    $prestador->editar($nome, $sobrenome, $endereco, $data_nasc, $cpf, $telefone, $email, $senha, $idPrestador);

    // Redireciona de volta para a página de gestão de prestadores
    header('Location: gestaoPrestadores.php');
    exit;
}
?>
