<?php
session_start();
include '../adm/classes/prestadores.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nome']) && !empty($_POST['sobrenome']) && !empty($_POST['data_nasc']) &&
        !empty($_POST['endereco']) && !empty($_POST['cpf']) && !empty($_POST['telefone']) &&
        !empty($_POST['email']) && !empty($_POST['senha'])) {

        // Sanitização e validação dos inputs
        $nome = htmlspecialchars(trim($_POST['nome']));
        $sobrenome = htmlspecialchars(trim($_POST['sobrenome']));
        $data_nasc = htmlspecialchars(trim($_POST['data_nasc']));
        $endereco = htmlspecialchars(trim($_POST['endereco']));
        $cpf = htmlspecialchars(trim($_POST['cpf']));
        $telefone = htmlspecialchars(trim($_POST['telefone']));
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $senha = htmlspecialchars(trim($_POST['senha']));

        if (!$email) {
            echo '<script type="text/javascript">alert("E-mail inválido.");</script>';
            exit();
        }

        $prestador = new Prestador();

        // Chamar o método adicionar e verificar se foi bem-sucedido
        if ($prestador->adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha)) {
            header("Location: login-prestador.php");
            exit();
        } else {
            echo '<script type="text/javascript">alert("Erro ao adicionar prestador. Por favor, tente novamente.");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Preencha todos os campos.");</script>';
    }
} else {
    echo '<script type="text/javascript">alert("Método de requisição inválido.");</script>';
}
?>
