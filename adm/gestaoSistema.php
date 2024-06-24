<?php
session_start();
require 'classes/sistema.class.php';
include 'inc/header.inc.php';

$sistema = new Sistema();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}
?>

<style type="text/css">
    .row{
        background-color: #ddc;
        padding:10px;
    }
</style>
<style>
  body {
    background-color: #ccc;
  }

  h1 {
    text-align: center;
  }
</style>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Gestão de Sistemas</h1>
        </div>
    </section>
    <a class="btn btn-primary" href="adicionarSistema.php">Adicionar</a>
    <br><br>
    <a class="btn btn-primary" href="login.php">Voltar</a>
    <br><br>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>NOME</th>
                                <th>VERSÃO</th>
                                <th>DESCRIÇÃO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lista = $sistema->listar();
                            foreach ($lista as $item):
                            ?>
                            <tr>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['versao']; ?></td>
                                <td><?php echo $item['descricao']; ?></td>
                                <td>
                                    <a href="verSistema.php?idSistema=<?php echo $item['idSistema'];?>" class="btn btn-info">VER</a>
                                    <a href="editarSistema.php?idSistema=<?php echo $item['idSistema'];?>" class="btn btn-warning">EDITAR</a>
                                    <a href="excluirSistema.php?idSistema=<?php echo $item['idSistema'];?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este sistema?')">EXCLUIR</a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>             
</main>

<?php
include 'inc/footer.inc.php';
?>
