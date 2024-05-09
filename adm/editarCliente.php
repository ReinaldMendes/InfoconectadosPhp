<?php
include 'inc/header.inc.php';
?>
<?php
    include 'classes/contatos.class.php';
    $contato = new Contatos();

    if(!empty($_GET['idUsuario'])){
        $idUsuario = $_GET['idUsuario'];
        $info = $contato->buscar($idUsuario);
        if(empty($info['email'])){
            header("Location: editarContato.php");
            exit;
        }
    }else{
        header("Location: editarContato.php");
            exit;
    }
?>
<h1>EDITAR CONTATO</h1>
<br> <br>
<form method="POST" action="editarContatoSubmit.php">
<input type ="hidden" name="idUsuario" value="<?php echo $info ['idUsuario']?>">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h4>Nome: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" value="<?php echo $info ['nome']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h4>Email: </h4></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" value="<?php echo $info ['email']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="senha" class="col-sm-2 col-form-label"><h4>Senha: </h4></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha" value="<?php echo $info ['senha']?>"/>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label"><h4>Detalhes do Perfil:</h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="detalhesDoPerfil" value="<?php echo $info ['detalhesDoPerfil']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="cpf" class="col-sm-2 col-form-label"><h4>Cpf: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cpf" value="<?php echo $info ['cpf']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label"><h4>Data de Nascimento: </h4></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="Data_Nasc" value="<?php echo $info ['Data_Nasc']?> "/>
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label"><h4>Telefone: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" value="<?php echo $info ['telefone']?> "/>
    </div>
    <button type="submit" class="btn btn-primary" name="btCadastrar" value = "SALVAR">Salvar</button>
   
  </div>
</form>
<?php
include 'inc/footer.inc.php';
?>
 