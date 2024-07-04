<?php
require_once 'classes/prestadores.class.php';

if (!empty($_GET['idPrestador'])) {
    $idPrestador = $_GET['idPrestador'];

    $prestador = new Prestador();
    $prestador->excluir($idPrestador);

    header("Location: gestaoPrestadores.php");
    exit;
} else {
    echo "Erro ao processar requisição.";
}
?>
