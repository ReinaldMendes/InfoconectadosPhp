<?php
session_start();
require 'classes/prestadores.class.php';

$prestador = new Prestador();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idPrestador'])) {
    $idPrestador = $_GET['idPrestador'];
    $info = $prestador->buscar($idPrestador);

    if (empty($info['email'])) {
        header("Location: editarPrestador.php");
        exit;
    }
} else {
    header("Location: editarPrestador.php");
    exit;
}

if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    if (!empty($email)) {
        $prestador->editar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha, $idPrestador);
        header('Location: gestaoPrestadores.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Prestador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Seu arquivo CSS para estilos -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'caminho_para_seu_header.php'; ?>

    <div class="container mt-4">
        <h2>Editar Prestador</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $info['nome']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $info['sobrenome']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="<?php echo $info['data_nasc']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $info['endereco']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $info['cpf']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $info['telefone']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $info['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $info['senha']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>

    <?php include 'inc/footer.inc.php'; ?>
</body>
</html>
