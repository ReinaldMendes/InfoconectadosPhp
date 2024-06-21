<?php
session_start(); 
require 'classes/users.class.php';
include 'inc/header.inc.php';

$users = new Users();
if(!isset($_SESSION['logado'])){
    header("Location: index.php");
    exit;
}
$users->setUsers($_SESSION['logado']);
?>
<style type="text/css">
    .row {
        background-color: #ddc;
        padding: 10px;
    }
</style>
<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Usuários</h1>
        </div>
    </section>
    <?php if ($users->temPermissoes('add')): ?>
        <a class="btn btn-primary" href="adicionarUsers.php">Adicionar Usuário</a>
    <?php endif; ?>
    <br><br>
    <a class="btn btn-primary" href="login.php">Voltar</a>
    <br><br>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lista = $users->listar();
                            foreach ($lista as $item):
                            ?>
                                <tr>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td>
                                        <?php if ($users->temPermissoes('super')): ?>
                                            <a href="verUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-info">VER</a>
                                        <?php endif; ?>
                                        <?php if ($users->temPermissoes('edit') || $users->temPermissoes('add')  ): ?>
                                            <a href="editarUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">EDITAR</a>
                                        <?php endif; ?>
                                        <?php if ($users->temPermissoes('del')): ?>
                                            <a href="excluirUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>           
</main>

<?php
include 'inc/footer.inc.php';
?>
