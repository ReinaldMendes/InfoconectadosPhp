<?php
session_start(); 
require 'classes/clients.class.php';
include 'inc/header.inc.php';

$cliente = new Cliente();



if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

?>

<link rel="stylesheet" href="css/style-gestao.css">
<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><h1>Gestão de Clientes</h1>
        </div>
    </section>
        <a class="btn btn-primary" href="adicionarCliente.php">Adicionar</a>
        <br><br>
        <a class="btn btn-primary" href="login.php">Voltar</a>
            <div class="container">
                <br><br>
                <div class ="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive">
                              <table class="table table-bordered table-dark">
                                <thead class="thead-dark">
                                    <tr>   
  
                                      <!--<th>IdCliente </th>-->
                                      <th>NOME </th>
                                     <!-- <th>SOBRENOME </th>-->
                                      <th>DATA_NASC</th>
                                      <th>ENDERECO </th>
                                      <th>QUAL SERVICO NECESSITA</th>
                                      <th>TELEFONE </th>
                                     <!-- <th>EMAIL </th>-->
                                      <!--<th>SENHA </th>-->
                                      <th>AÇÕES </th>
                                    </tr>
                                    <?php
                                    $lista = $cliente->listar();
                                    foreach ($lista as $item):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <!--<td><?php //echo $item['idCliente']; ?> </td>-->
                                            <td><?php echo $item['nome']; ?> </td>
                                           <!-- <td><?php echo $item['sobrenome']; ?> </td>-->
                                            <td><?php echo implode ("/",array_reverse (explode("-",$item['data_nasc'])));?></td>
                                            <td><?php echo $item['endereco']; ?> </td>
                                            <td><?php echo $item['qualServicoNecessita']; ?> </td>
                                            <td><?php echo $item['telefone']; ?> </td>
                                            <!--<td><?php echo $item['email']; ?> </td>-->
                                             <!--<td><?php //echo $item['senha']; ?> </td>-->
                          
                                            <td>
                                                <a href="verClientes.php?idCliente=<?php echo $item['idCliente'];?>" class="btn btn-info">VER</a>
                                                <a href="editarCliente.php?idCliente=<?php echo $item ['idCliente'];?>"class="btn btn-warning">EDITAR</a>
                                                <a href="excluirCliente.php?idCliente=<?php echo $item ['idCliente'];?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    endforeach;
                                    ?>
                              </table>
                            </div>
                       </div> 
                      </div>
                    </div>             
</main>
<?php
include 'inc/footer.inc.php';
?>

