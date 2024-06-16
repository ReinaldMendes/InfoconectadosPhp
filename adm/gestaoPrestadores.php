<?php
session_start();
require 'classes/prestadores.class.php';

$prestador = new Prestador();

if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit;
}

$lista = $prestador->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Prestadores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Seu arquivo CSS para estilos -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'caminho_para_seu_header.php'; ?>

    <div class="container mt-4">
        <h2>Gestão de Prestadores</h2>
        <a href="adicionarPrestador.php" class="btn btn-success mb-3">Adicionar Prestador</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Sobrenome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $prestador) : ?>
                    <tr>
                        <th scope="row"><?php echo $prestador['idPrestador']; ?></th>
                        <td><?php echo $prestador['nome']; ?></td>
                        <td><?php echo $prestador['sobrenome']; ?></td>
                        <td><?php echo $prestador['data_nasc']; ?></td>
                        <td><?php echo $prestador['endereco']; ?></td>
                        <td><?php echo $prestador['cpf']; ?></td>
                        <td><?php echo $prestador['telefone']; ?></td>
                        <td><?php echo $prestador['email']; ?></td>
                        <td>
                            <a href="editarPrestador.php?idPrestador=<?php echo $prestador['idPrestador']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="excluirPrestador.php?idPrestador=<?php echo $prestador['idPrestador']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'inc/footer.inc.php'; ?>
</body>
</html>
