<?php
session_start();
require 'classes/clients.class.php';
include 'inc/header.inc.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$cliente = new Cliente();
if (isset($_GET['idCliente']) && !empty($_GET['idCliente'])) {
    $idCliente = $_GET['idCliente'];
    $dados = $cliente->buscar($idCliente);
} else {
    header("Location: gestaoCliente.php");
    exit;
}
?>
<link rel="stylesheet" href="css/style-ver.css">

<main>
  <section class="jumbotron text-black-50 text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Detalhes do Cliente</h1>
    </div>
  </section>
  <div class="container">
    <table class="contact-table">
      <caption>Informações do Cliente</caption>
      <tr>
        <th>Nome</th>
        <td><?php echo $dados['nome']; ?></td>
      </tr>
      <tr>
        <th>Sobrenome</th>
        <td><?php echo $dados['sobrenome']; ?></td>
      </tr>
      <tr>
        <th>Data de Nascimento</th>
        <td><?php echo implode("/", array_reverse(explode("-", $dados['data_nasc']))); ?></td>
      </tr>
      <tr>
        <th>Endereço</th>
        <td><?php echo $dados['endereco']; ?></td>
      </tr>
      <tr>
        <th>Qual Serviço Necessita</th>
        <td><?php echo $dados['qualServicoNecessita']; ?></td>
      </tr>
      <tr>
        <th>Telefone</th>
        <td><?php echo $dados['telefone']; ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $dados['email']; ?></td>
      </tr>
      <tr>
        <th>Senha</th>
        <td><?php echo $dados['senha']; ?></td>
      </tr>
    </table>
    <br>
    <a href="gestaoCliente.php" class="btn btn-secondary">Voltar</a>
  </div>
</main>
<?php
include 'inc/footer.inc.php';
?>
