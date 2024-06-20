<?php
session_start();
require 'classes/prestadores.class.php';
include 'inc/header.inc.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$prestador = new Prestador();
if (isset($_GET['idPrestador']) && !empty($_GET['idPrestador'])) {
    $idPrestador = $_GET['idPrestador'];
    $dados = $prestador->buscar($idPrestador);
} else {
    header("Location: gestaoPrestadores.php");
    exit;
}
?>

<style>
  body {
    background-color: #ccc;
  }
  .contact-table {
    width: 60%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #ddd;
  }
  .contact-table th, .contact-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  .contact-table th {
    background-color: #f2f2f2;
  }
  .contact-table caption {
    font-size: 24px;
    margin-bottom: 10px;
  }
</style>

<main>
  <section class="jumbotron text-black-50 text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Detalhes do Prestador</h1>
    </div>
  </section>
  <div class="container">
    <table class="contact-table">
      <caption>Informações do Prestador</caption>
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
        <th>CPF</th>
        <td><?php echo $dados['cpf']; ?></td>
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
    <a href="gestaoPrestadores.php" class="btn btn-secondary">Voltar</a>
  </div>
</main>
<?php
include 'inc/footer.inc.php';
?>
