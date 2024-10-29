<?php
require_once '../adm/classes/prestadores.php';

if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $prestador = new Prestador();

    // Assumindo que o `listarClientesPorCategoria` é o método criado na classe `Prestador`
    $clientesPorCategoria = $prestador->listarClientesPorCategoria($categoria);

    // Retorna os dados no formato JSON
    echo json_encode($clientesPorCategoria);
} else {
    echo json_encode([]);
}
?>
