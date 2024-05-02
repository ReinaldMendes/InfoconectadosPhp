<?php
include 'inc/header.inc.php';
?>
<style>
 

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
  }

  .loll-image {
    display: block; /* Garante que a imagem será tratada como um bloco */
    margin: 0 auto; /* Centraliza a imagem na horizontal */
  }

  .container-fluid {
    padding-top: 50px; /* Ajuste para afastar o conteúdo do topo, para que não fique escondido pela imagem de fundo */
  }
</style> 
<br> <br>
<form method="POST" action="adicionarContatoSubmit.php">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h4>Nome: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" placeholder="Nome">
    </div>
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
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label"><h4>Detalhes do Perfil:</h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="detalhesDoPerfil" placeholder="Detalhes do Perfil">
    </div>
  </div>
  <div class="form-group row">
    <label for="cpf" class="col-sm-2 col-form-label"><h4>Cpf: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cpf" placeholder="Cpf">
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label"><h4>Data de Nascimento: </h4></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="Data_Nasc" placeholder="Data Nascimento">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label"><h4>Telefone: </h4></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" placeholder="Telefone">
    </div>
    <button type="submit" class="btn btn-primary" name="btCadastrar" value = "Adicionar">Adicionar</button>
   
  </div>
</form>
<?php
include 'inc/footer.inc.php';
?>