<?php

require_once 'inc/header.inc.php';
session_start(); 
if(!isset($_SESSION['logado'])){
  header("Location: index.php");
  exit;
}
?>
 
<br> <br>
<form method="POST" action="adicionarClienteSubmit.php">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h4>Nome: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" placeholder="Nome">
    </div>
  </div>
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h4>Sobrenome: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="sobrenome" placeholder="Sobreome">
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label"><h4>Data de Nascimento: </h4></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="data_nasc" placeholder="Data de Nascimento">
    </div>
  </div>
  <div class="form-group row">
    <label for="endereco" class="col-sm-2 col-form-label"><h4>Endereço:</h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="endereco" placeholder="Endereço">
    </div>
  </div>
  <div class="form-group row">
    <label for="qualServicoNecessita" class="col-sm-2 col-form-label"><h4>Qual serviço necessita:</h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="qualServicoNecessita" placeholder="Digite aqui">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label"><h4>Telefone: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" placeholder="Telefone">
    </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h4>Email: </h4></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="senha" class="col-sm-2 col-form-label"><h4>Senha: </h4></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha" placeholder="Digite uma senha">
    </div>
  </div>
  <br><br>
  <input type="submit" name="btCadastrar" class="btn btn-primary" value="Adicionar">
</form>

<?php
include 'inc/footer.inc.php';
?>