<?php
include 'inc/header.inc.php';

include 'classes/prestadores.class.php';
$prestador = new Prestador();

if(!empty($_GET['idPrestador'])){
    $idPrestador = $_GET['idPrestador'];
    $info = $prestador->buscar($idPrestador);
    if(empty($info['email'])){
        header("Location: editarPrestador.php");
        exit;
    }
}else{
    header("Location: editarPrestador.php");
    exit;
}

if(isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}
?>

<h1>EDITAR PRESTADOR</h1>
<br><br>
<form method="POST" action="editarPrestadorSubmit.php">
    <input type="hidden" name="idPrestador" value="<?php echo $info['idPrestador']; ?>">
    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label"><h4>Nome: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nome" value="<?php echo $info['nome']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="sobrenome" class="col-sm-2 col-form-label"><h4>Sobrenome: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="sobrenome" value="<?php echo $info['sobrenome']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="data_nasc" class="col-sm-2 col-form-label"><h4>Data Nascimento: </h4></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="data_nasc" value="<?php echo $info['data_nasc']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="endereco" class="col-sm-2 col-form-label"><h4>Endereço: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="endereco" value="<?php echo $info['endereco']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="cpf" class="col-sm-2 col-form-label"><h4>CPF: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="cpf" value="<?php echo $info['cpf']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="telefone" class="col-sm-2 col-form-label"><h4>Telefone: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="telefone" value="<?php echo $info['telefone']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><h4>Email: </h4></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" value="<?php echo $info['email']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label"><h4>Senha: </h4></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="senha" value="<?php echo $info['senha']; ?>"/>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary" name="btCadastrar" value="SALVAR">Salvar</button>
</form>

<?php
include 'inc/footer.inc.php';
?>
