<?php
session_start();
require 'classes/prestadores.class.php';

$prestador = new Prestador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    if ($prestador->adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha)) {
        header('Location: gestaoPrestadores.php');
        exit;
    } else {
        echo '<script>alert("Erro ao adicionar prestador!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Prestador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Seu arquivo CSS para estilos -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'caminho_para_seu_header.php'; ?>
    
    <div class="container mt-4">
        <h2>Adicionar Prestador</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>
            
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Adicionar Prestador</button>
        </form>
    </div>

    <?php include 'caminho_para_seu_footer.php'; ?>
</body>
</html>
