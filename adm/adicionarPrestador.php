<?php
session_start();
require_once 'inc/header.inc.php';
if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit;
}
?>

<br><br>
<div class="container">
    <h1 class="jumbotron-heading">Adicionar Prestador</h1>
</div>
<br><br>

<form method="POST" action="adicionarPrestadoresSubmit.php">
    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nome" placeholder="Nome">
        </div>
    </div>
    <div class="form-group row">
        <label for="sobrenome" class="col-sm-2 col-form-label"><h5>Sobrenome: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome">
        </div>
    </div>
    <div class="form-group row">
        <label for="data_nasc" class="col-sm-2 col-form-label"><h5>Data de Nascimento: </h5></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="data_nasc">
        </div>
    </div>
    <div class="form-group row">
        <label for="endereco" class="col-sm-2 col-form-label"><h5>Endereço: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="endereco" placeholder="Endereço">
        </div>
    </div>
    <div class="form-group row">
        <label for="cpf" class="col-sm-2 col-form-label"><h5>CPF: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="cpf" placeholder="CPF">
        </div>
    </div>
    <div class="form-group row">
        <label for="telefone" class="col-sm-2 col-form-label"><h5>Telefone: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="telefone" placeholder="Telefone">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="senha" placeholder="Senha">
        </div>
    </div>
    <br><br>
    <input type="submit" name="btCadastrar" class="btn btn-primary" value="Adicionar">
</form>

<?php
include 'inc/footer.inc.php';
?>
