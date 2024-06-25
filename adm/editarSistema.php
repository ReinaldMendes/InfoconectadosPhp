<?php
session_start();
require 'classes/sistema.class.php';
include 'inc/header.inc.php';

$sistema = new Sistema();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

if(isset($_GET['idSistema'])) {
    $idSistema = $_GET['idSistema'];
    $sistemaAtual = $sistema->buscar($idSistema); // Corrigido para usar o método buscar()

    if(empty($sistemaAtual)) {
        header("Location: gestaoSistema.php");
        exit;
    }
} else {
    header("Location: gestaoSistema.php");
    exit;
}

if(isset($_POST['editarSistema'])) {
    $nome = $_POST['nome'];
    $versao = $_POST['versao'];
    $descricao = $_POST['descricao'];

    $atualizado = $sistema->editar($nome, $versao, $descricao, $idSistema);

    if($atualizado) {
        $_SESSION['mensagem'] = "Sistema atualizado com sucesso!";
        header("Location: gestaoSistema.php");
        exit;
    } else {
        $erro = "Erro ao atualizar o sistema.";
    }
}

?>

<style type="text/css">
    .row {
        background-color: #ddc;
        padding: 10px;
    }
</style>
<style>
  body {
    background-color: #ccc;
  }

  h1 {
    text-align: center;
  }
</style>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Editar Sistema</h1>
        </div>
    </section>
    <br>

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-6">
                <form method="POST">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $sistemaAtual['nome']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="versao">Versão:</label>
                        <input type="text" class="form-control" id="versao" name="versao" value="<?php echo $sistemaAtual['versao']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo $sistemaAtual['descricao']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editarSistema">Salvar Alterações</button>
                    <a href="gestaoSistema.php" class="btn btn-secondary">Cancelar</a>
                </form>
                <?php if(isset($erro)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $erro; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<br><br>

<?php
include 'inc/footer.inc.php';
?>
