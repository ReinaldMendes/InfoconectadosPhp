<?php
session_start();
require_once '../adm/classes/avaliacao.php';
require_once '../adm/classes/conexao.class.php'; // Certifique-se de incluir a conexão corretamente

if (!isset($_SESSION["logado"])) {
    header("Location: login-cliente.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validação básica dos inputs
    $idCliente = isset($_POST["idCliente"]) ? intval($_POST["idCliente"]) : null;
    $idPrestador = isset($_POST["idPrestador"]) ? intval($_POST["idPrestador"]) : null;
    $nota = isset($_POST["nota"]) ? intval($_POST["nota"]) : null;
    $comentario = isset($_POST["comentario"]) ? trim(htmlspecialchars($_POST["comentario"])) : null;

    if (!$idCliente || !$idPrestador || !$nota || !$comentario) {
        echo "<p>Preencha todos os campos obrigatórios para avaliar.</p>";
        exit;
    }

    // Conectar ao banco e salvar avaliação
    try {
        $conexao = new Conexao();
        $avaliacao = new Avaliacao($conexao); // Passando a conexão à classe
        $resultado = $avaliacao->salvarAvaliacao($idCliente, $idPrestador, $nota, $comentario);

        if ($resultado) {
            header("Location: contatarPrestador.php?idPrestador=$idPrestador&sucesso=1");
            exit;
        } else {
            echo "<p>Erro ao salvar a avaliação. Tente novamente.</p>";
        }
    } catch (Exception $e) {
        error_log("Erro ao salvar avaliação: " . $e->getMessage());
        echo "<p>Erro ao salvar a avaliação. Tente novamente mais tarde.</p>";
    }
} else {
    header("Location: dashboardCliente.php");
    exit;
}
?>
