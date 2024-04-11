
<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
?>
<?php
include 'inc/header.inc.php';
?>
<style>
  body {
    background-color: black;
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

<h1>Infoconectados</h1>
<button> <a href = "adicionarContato.php"> Adicionar </a></button>
<br><br>
<table border ="2" width = 100% > 
    <tr>
      <th>ID </th>
      <th>NOME </th>
      <th>EMAIL </th>
      <th>TELEFONE </th>
      <th>CIDADE </th>
      <th>RUA </th>
      <th>NÚMERO </th>
      <th>BAIRRO </th>
      <th>CEP </th>
      <th>PROFISSÃO </th>
      <th>FOTO </th>
      <th>AÇÕES </th>
    </tr>
    <?php
    $lista = $contato->listar();
    foreach ($lista as $item):
    ?>
    <tbody>
        <tr>
            <td><?php echo $item['id']; ?> </td>
            <td><?php echo $item['nome']; ?> </td>
            <td><?php echo $item['email']; ?> </td>
            <td><?php echo $item['telefone']; ?> </td>
            <td><?php echo $item['cidade']; ?> </td>
            <td><?php echo $item['rua']; ?> </td>
            <td><?php echo $item['numero']; ?> </td>
            <td><?php echo $item['bairro']; ?> </td>
            <td><?php echo $item['cep']; ?> </td>
            <td><?php echo $item['profissao']; ?> </td>
            <td><?php echo $item['foto']; ?> </td>
            <td>
                <a href="editarContato.php?id=<?php echo $item ['id'];?>">EDITAR</a>
                <a href="#">|EXCLUIR</a>
            </td>
        </tr>
    </tbody>
    <?php
    endforeach;
    ?>
</table>
<?php
include 'inc/footer.inc.php';
?>

