<?php
include 'inc/header.inc.php';


    include 'classes/clients.class.php';
    $cliente = new Cliente();

    if(!empty($_GET['idCliente'])){
        $idUsuario = $_GET['idCliente'];
        $info = $cliente->buscar($idCliente);
        if(empty($info['email'])){
            header("Location: editarCliente.php");
            exit;
        }
    }else{
        header("Location: editarCliente.php");
            exit;
    }
?>
 
<h1>EDITAR CLIENTE</h1>
<br> <br>
<form method="POST" action="editarClienteSubmit.php">
<input type ="hidden" name="idCliente" value="<?php echo $info ['idCliente']?>">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h4>Nome: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" value="<?php echo $info ['nome']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h4>Sobrenome: </h4></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="sobrenome" value="<?php echo $info ['sobrenome']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label"><h4>Data Nascimento: </h4></label>
    <div class="col-sm-10">
      <input type="data" class="form-control" name="data_nasc" value="<?php echo $info ['data_nasc']?>"/>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label"><h4>Endereço:</h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="endereco" value="<?php echo $info ['endereco']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="cpf" class="col-sm-2 col-form-label"><h4>Cpf: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cpf" value="<?php echo $info ['cpf']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="qualServicoNecessita" class="col-sm-2 col-form-label"><h4>Qual serviço necessita: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="qualServicoNecessita" value="<?php echo $info ['qualServicoNecessitac']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label"><h4>Telefone: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" value="<?php echo $info ['telefone']?> "/>
    </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h4>Email: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" value="<?php echo $info ['email']?> "/>
    </div>  
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h4>Senha: </h4></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha" value="<?php echo $info ['senha']?> "/>
    </div> 
    <button type="submit" class="btn btn-primary" name="btCadastrar" value = "SALVAR">Salvar</button>
   
  </div>
</form>
<?php
include 'inc/footer.inc.php';
?>
 