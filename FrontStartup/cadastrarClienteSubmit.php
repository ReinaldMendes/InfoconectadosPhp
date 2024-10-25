<?php
session_start();
require '../adm/classes/cliente.php'; // Inclua a classe Cliente

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Verifique se o método de requisição é POST
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        // Captura os dados do formulário
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $data_nasc = $_POST['data_nasc'];
        $endereco = $_POST['endereco'];
        $qualServicoNecessita = $_POST['qualServicoNecessita']; // Campo do tipo serviço
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $cliente = new Cliente(); // Cria uma nova instância da classe Cliente

        // Adiciona o cliente
        if ($cliente->adicionar($nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha)) {
            header("Location: login-cliente.php"); // Redireciona para a página de login de clientes
            exit();
        } else {
            echo '<script type="text/javascript">alert("Erro ao adicionar cliente: Email já cadastrado.");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Preencha todos os campos.");</script>';
    }
} else {
    echo '<script type="text/javascript">alert("Método de requisição inválido.");</script>';
}
?>
