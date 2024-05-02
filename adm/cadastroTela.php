
<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
?>
<?php
include 'inc/header.inc.php';
?>
<style>
  body {
    background-color: #ccc;
    
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
  }

  
</style>
<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><h1>Gestão de Usuarios</h1>
        </div>
    </section>
        <a class="btn btn-primary" href="adicionarContato.php">Adicionar</a>
        <br><br>
            <div class="container">
                <div class ="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive">
                              <table class="table table-bordered table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                      <!--<th>IDUsuario </th>-->
                                      <th>NOME </th>
                                      <th>EMAIL </th>
                                      <!--<th>SENHA </th>-->
                                      <th>DETALHESDOPERFIL </th>
                                      <th>CPF </th>
                                      <th>DATA_NASC</th>
                                      <th>TELEFONE </th>
                                      <th>AÇÕES </th>
                                    </tr>
                                    <?php
                                    $lista = $contato->listar();
                                    foreach ($lista as $item):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <!--<td><?php //echo $item['idUsuario']; ?> </td>-->
                                            <td><?php echo $item['nome']; ?> </td>
                                            <td><?php echo $item['email']; ?> </td>
                                            <!--<td><?php //echo $item['senha']; ?> </td>-->
                                            <td><?php echo $item['detalhesDoPerfil']; ?> </td>
                                            <td><?php echo $item['cpf']; ?> </td>
                                            <td><?php echo implode ("/",array_reverse (explode("-",$item['Data_Nasc'])));?></td>
                                            <td><?php echo $item['telefone']; ?> </td>
                          
                                            <td>
                                                <a href="editarContato.php?idUsuario=<?php echo $item ['idUsuario'];?>"class="btn btn-warning">EDITAR</a>
                                                <a href="excluirContato.php?idUsuario=<?php echo $item ['idUsuario'];?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
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

