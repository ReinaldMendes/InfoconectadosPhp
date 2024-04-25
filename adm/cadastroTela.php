
<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
?>
<?php
include 'inc/header.inc.php';
?>
<style>
  body {
    background-color: #ccc;
    
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
  }

  
</style>

<h1>Infoconectados</h1>
<button> <a href = "adicionarContato.php"> Adicionar </a></button>
<br><br>
<table border ="2" width = 100% > 
    <tr>//idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
      <th>IDUsuario </th>
      <th>NOME </th>
      <th>EMAIL </th>
      <th>SENHA </th>
      <th>DETALHESDOPERFIL </th>
      <th>CPF </th>
      <th>DATA_NASC</th>
      <th>TELEFONE </th>
      <th>AÇÕES </th>
    </tr>
    <?php
    $lista = $contato->listar();
    foreach ($lista as $item):
    ?>
    <tbody>
        <tr>
            <td><?php echo $item['idUsuario']; ?> </td>
            <td><?php echo $item['nome']; ?> </td>
            <td><?php echo $item['email']; ?> </td>
            <td><?php echo $item['senha']; ?> </td>
            <td><?php echo $item['detalhesDoPerfil']; ?> </td>
            <td><?php echo $item['cpf']; ?> </td>
            <td><?php echo $item['Data_Nasc']; ?> </td>
            <td><?php echo $item['telefone']; ?> </td>
      
            <td>
            <a href="editarContato.php?idUsuario=<?php echo $item ['idUsuario'];?>">EDITAR</a>
                <a href="excluirContato.php?idUsuario=<?php echo $item ['idUsuario'];?>"onclick="return confirm('Tem certeza que quer excluir este contato?')">|EXCLUIR</a>
        </tr>
    </tbody>
    <?php
    endforeach;
    ?>
</table>
<?php
include 'inc/footer.inc.php';
?>

