<?php
session_start();
require_once 'inc/header.php';
require_once '../adm/classes/cliente.php';

// Verificação de Sessão
if (!isset($_SESSION["logado"])) {
    header("Location: login-cliente.php");
    exit;
}

$cliente = new Cliente();
$idCliente = $_SESSION["logado"];
$dadosCliente = $cliente->buscar($idCliente);

// Processar atualização de perfil
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $foto = $_FILES['foto'];

    // Atualizar dados do cliente
    $cliente->atualizarPerfil($idCliente, $nome, $sobrenome, $email, $telefone);

    // Processar upload de foto de perfil, se houver
    if (!empty($foto['name'])) {
        $nomeFoto = $idCliente . "_" . basename($foto["name"]);
        $caminhoFoto = "img/perfis/" . $nomeFoto;
        
        // Verifica se o upload é uma imagem
        $tipoImagem = strtolower(pathinfo($caminhoFoto, PATHINFO_EXTENSION));
        $tiposPermitidos = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($tipoImagem, $tiposPermitidos)) {
            if (move_uploaded_file($foto["tmp_name"], $caminhoFoto)) {
                $cliente->atualizarFotoPerfil($idCliente, $nomeFoto);
                $dadosCliente['foto'] = $nomeFoto;
                echo "<script>alert('Perfil atualizado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao fazer o upload da foto.');</script>";
            }
        } else {
            echo "<script>alert('Formato de imagem inválido. Use jpg, jpeg, png ou gif.');</script>";
        }
    }
    
    // Atualizar os dados do cliente após a edição
    $dadosCliente = $cliente->buscarDadosCliente($idCliente);
}
?>

<link rel="stylesheet" href="css/style-perfil.css">

<div class="perfil-container">
    <div class="header-profile">
        <h2>Perfil do Cliente</h2>
    </div>
    <form method="POST" enctype="multipart/form-data" class="perfil-form">
        <div class="perfil-info">
            <!-- Foto do Cliente -->
            <div class="foto-perfil">
                <img src="img/perfis/<?php echo htmlspecialchars($dadosCliente['foto'] ?? 'default-avatar.png'); ?>" alt="Foto de Perfil" class="foto-avatar">
                <input type="file" name="foto" accept="image/*" class="foto-upload">
            </div>
            <!-- Detalhes do Cliente -->
            <div class="dados-perfil">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($dadosCliente['nome']); ?>" required>
                
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome" id="sobrenome" value="<?php echo htmlspecialchars($dadosCliente['sobrenome']); ?>" required>
                
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($dadosCliente['email']); ?>" required>
                
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($dadosCliente['telefone']); ?>">
            </div>
        </div>
        <div class="profile-buttons">
            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
        </div>
    </form>
</div>

<footer>
    <p>&copy; 2024 Infoconectados. Todos os direitos reservados.</p>
</footer>
