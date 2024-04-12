<?php
    include 'classes/contatos.class.php';
    $contato = new Contatos();

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $info = $contato->buscar($id);
        if(empty($info['email'])){
            header("Location: /infoconectadosPhp");
            exit;
        }
    }else{
        header("Location: /infoconectadorPhp");
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
    <input type ="hidden" name="id" value="<?php echo $info ['id']?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info ['nome']?>"/><br><br>
    Email: <br>
    <input type="text" name="email" value="<?php echo $info ['email']?>"/><br><br>
    Telefone: <br>
    <input type="text" name="telefone" value="<?php echo $info ['telefone']?>"/><br><br>
    Cidade: <br>
    <input type="text" name="cidade" value="<?php echo $info ['cidade']?>"/><br><br>
    Rua: <br>
    <input type="text" name="rua" value="<?php echo $info ['rua']?>"/><br><br>
    Número: <br>
    <input type="text" name="numero" value="<?php echo $info ['numero']?>"/><br><br>
    Bairro: <br>
    <input type="text" name="bairro" value="<?php echo $info ['bairro']?>"/><br><br>
    Cep: <br>
    <input type="text" name="cep" value="<?php echo $info ['cep']?>"/><br><br>
    Profissão: <br>
    <input type="text" name="profissao" value="<?php echo $info ['profissao']?>"/><br><br>
    Foto: <br>
    <input type="text" name="foto" value="<?php echo $info ['foto']?>"/><br><br>
   
    <input type="submit" name="btCadastrar" value="SALVAR"/>
 </form>
 
 