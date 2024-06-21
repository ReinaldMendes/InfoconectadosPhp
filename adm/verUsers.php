<?php
session_start();
require 'classes/users.class.php';
include 'inc/header.inc.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$users = new Users();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $dados = $users->buscar($id);
} else {
    header("Location: gestaoUsuario.php");
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
      <h1 class="jumbotron-heading">Detalhes do Usuario</h1>
    </div>
  </section>
  <div class="container">
    <table class="contact-table">
      <caption>Informações do Usuario</caption>
      <tr>
        <th>Nome</th>
        <td><?php echo $dados['nome']; ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $dados['email']; ?></td>
      </tr>
      <tr>
        <th>Senha</th>
        <td><?php echo $dados['senha']; ?></td>
      </tr>
      <tr>
        <th>Permissões</th>
        <td><?php echo $dados['permissoes']; ?></td>
      </tr>
    </table>
    <br>
    <a href="gestaoUsuario.php" class="btn btn-secondary">Voltar</a>
  </div>
</main>
<?php
include 'inc/footer.inc.php';
?>
