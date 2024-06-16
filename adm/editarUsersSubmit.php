<?php
include 'classes/users.class.php';
$users = new Users();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id = $_POST['id'];

    // Verifique se "permissoes" está definido e é um array
    if (isset($_POST['permissoes']) || is_array($_POST['permissoes'])) {
        $permissoes = implode(',', $_POST['permissoes']);
    } else {
        $permissoes = 'super'; // Defina um valor padrão se "permissoes" não estiver definido ou não for um array
    }

    if (!empty($email)) {
        $users->editar($nome, $email, $senha, $permissoes, $id);
    }

    header('Location:/InfoconectadosPHP/adm/gestaoUsuario.php');
    exit; // Certifique-se de chamar exit após o redirecionamento para parar a execução do script
} else {
    echo '<script type="text/javascript">alert("ID do usuário não fornecido!");</script>';
}
?>
