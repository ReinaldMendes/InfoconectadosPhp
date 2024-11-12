<?php include 'inc/header.php'; ?>

<!-- Incluir o novo CSS -->
<link rel="stylesheet" href="css/style-cadastro.css">

<!-- Container principal -->
<div class="container">
    <h1 class="jumbotron-heading">Bem-vindo ao Cadastro de Prestadores</h1>
    <p class="welcome-message">
        Estamos felizes em tê-lo conosco! Por favor, preencha o formulário abaixo com suas informações. 
        Certifique-se de que todos os dados estejam corretos para facilitar seu cadastro e acesso aos nossos serviços.
    </p>
</div>

<!-- Formulário de cadastro -->
<form method="POST" action="cadastroPrestadoresSubmit.php">
    <div class="form-group row mb-3">
        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome:</h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="sobrenome" class="col-sm-2 col-form-label"><h5>Sobrenome:</h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="data_nasc" class="col-sm-2 col-form-label"><h5>Data de Nascimento:</h5></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="endereco" class="col-sm-2 col-form-label"><h5>Endereço:</h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="cpf" class="col-sm-2 col-form-label"><h5>CPF:</h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" pattern="\d{11}" title="Digite um CPF válido (11 dígitos)" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="telefone" class="col-sm-2 col-form-label"><h5>Telefone:</h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" pattern="\d{10,11}" title="Digite um telefone válido (10 ou 11 dígitos)" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="email" class="col-sm-2 col-form-label"><h5>Email:</h5></label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha:</h5></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" autocomplete="off" required>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" name="btCadastrar" class="btn btn-primary">Adicionar</button>
    </div>
</form>

<?php include 'inc/footer.php'; ?>
