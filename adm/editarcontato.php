<?php
    include 'classes/contatos.class.php';
    $contato = new Contatos();

    if(!empty($_GET['idUsuario'])){
        $id = $_GET['idUsuario'];
        $info = $contato->buscar($idUsuario);
        if(empty($info['email'])){
            header("Location: /adm/index.php");
            exit;
        }
    }else{
        header("Location: /adm/index.php");
            exit;
    }
?>
<?php
include 'inc/header.inc.php';
?>
<style>
  body {
    background-color: #ccc;
    background-image: url('img/logo.png'); /* substitua 'caminho/para/sua/imagem.jpg' pelo caminho correto para sua imagem */
    background-size: small; /* garante que a imagem cubra todo o fundo */
    background-position: center; /* centraliza a imagem no fundo */
    background-repeat: no-repeat; /* evita repetição da imagem */
    color: white; /* define a cor do texto como branca para melhor legibilidade */
  }

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
<h1>EDITAR CONTATO</h1>
 <form method="POST" action="editarContatoSubmit.php">
    <input type ="hidden" name="idUsuario" value="<?php echo $info ['idUsuario']?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info ['nome']?>"/><br><br>
    Email: <br>
    <input type="text" name="email" value="<?php echo $info ['email']?>"/><br><br>
    Senha: <br>
    <input type="text" name="telefone" value="<?php echo $info ['senha']?>"/><br><br>
    DetalhesDoPerfil: <br>
    <input type="text" name="cidade" value="<?php echo $info ['detalhesDoPerfil']?>"/><br><br>
    Cpf: <br>
    <input type="text" name="rua" value="<?php echo $info ['cpf']?>"/><br><br>
    Data_Nasc: <br>
    <input type="text" name="numero" value="<?php echo $info ['Data_Nasc']?>"/><br><br>
    Telefone: <br>
    <input type="text" name="bairro" value="<?php echo $info ['telefone']?>"/><br><br>
   
    <input type="submit" name="btCadastrar" value="SALVAR"/>
 </form>
 
 