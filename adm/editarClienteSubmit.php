<?php
  include 'classes/clients.class.php';
  $cliente = new Cliente();
if(!empty($_POST['idCliente'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $qualServicoNecessita = $_POST['qualServicoNecessita'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $idCliente = $_POST['idCliente'];
  


 if (!empty($senha)) {
        $senha = md5($senha);
    } else {
        // Caso a senha esteja vazia, mantenha a senha existente no banco de dados
        $currentInfo = $prestador->buscar($idPrestador);
        $senha = $currentInfo['senha'];
    }

    // Executa a edição do prestador
    $cliente->editar( $nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $data_nasc, $email, $senha, $idCliente);
    

    // Redireciona de volta para a página de gestão de prestadores
    header('Location: gestaoCliente.php');
    exit;
  }
?>