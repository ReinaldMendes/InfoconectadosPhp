<?php
session_start();
require 'classes/prestadores.class.php';
include 'inc/header.inc.php';

$prestador = new Prestador();

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
            <h1 class="jumbotron-heading">Gestão de Prestadores</h1>
        </div>
    </section>
    <a class="btn btn-primary" href="adicionarPrestador.php">Adicionar</a>
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
                                <th>SOBRENOME</th>
                                <th>DATA_NASC</th>
                                <!--<th>ENDERECO</th>-->
                               <!-- <th>CPF</th>-->
                                <th>TELEFONE</th>
                                <th>EMAIL</th>
                               <!-- <th>SENHA</th>-->
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lista = $prestador->listar();
                            foreach ($lista as $item):
                            ?>
                            <tr>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['sobrenome']; ?></td>
                                <td><?php echo implode("/", array_reverse(explode("-", $item['data_nasc']))); ?></td>
                                <!--<td><?php echo $item['endereco']; ?></td>-->
                                <!--<td><?php echo $item['cpf']; ?></td>-->
                                <td><?php echo $item['telefone']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <!--<td><?php echo $item['senha']; ?></td>-->
                                <td>
                                    <a href="verPrestadores.php?idPrestador=<?php echo $item['idPrestador'];?>" class="btn btn-info">VER</a>
                                    <a href="editarPrestador.php?idPrestador=<?php echo $item['idPrestador'];?>" class="btn btn-warning">EDITAR</a>
                                    <a href="excluirPrestador.php?idPrestador=<?php echo $item['idPrestador'];?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este prestador?')">EXCLUIR</a>
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
