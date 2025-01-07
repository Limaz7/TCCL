<?php

session_start();
require '../../../conexao.php';
$conexao = conectar();

$message = null;
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postFilters = array_map("strip_tags", $post);

foreach ($postFilters as $index => $value) {
}
usleep(50000);

if (!$_SESSION['cart'] || empty($_SESSION['cart'])) {
    $message = [
        'message' => 'Não foi possível excluir esse produto',
        'status' => 'error',
        'redirect' => ''
    ];

    echo json_encode($message);
    return;
}

$cart = "SELECT cart_id, cart_session, quantidade, cart_status, id_ingresso 
         FROM ingressos_comprados WHERE cart_session = " . $_SESSION['cart'] . " AND cart_status = 1 AND cart_id = $index";
$cart = executarSQL($conexao, $cart);

foreach ($cart as $Sh) {
}

$prodId = strip_tags($Sh['id_ingresso']);
$quantidade = strip_tags($Sh['quantidade']);

$Product = "SELECT id_ingresso, estoque, status
         FROM ingressos_cadastrados WHERE id_ingresso = $prodId AND status = 1";
$Product = executarSQL($conexao, $Product);

foreach ($Product as $Show) {
}

$productId = strip_tags($Show['id_ingresso']);
$productStock = strip_tags($Show['estoque']);
$stock = $productStock + $quantidade;

$update = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$productId'";
executarSQL($conexao, $update);

$delete = "DELETE FROM ingressos_comprados WHERE cart_id = $index";
executarSQL($conexao, $delete);

if ($delete) {
    $message = [
        'message' => "O produto foi removido do carrinho",
        'status' => 'success',
        'redirect' => ''
    ];
} else {
    $message = [
        'message' => 'Não foi possivel remover o produto do carrinho',
        'status' => 'error',
        'redirect' => ''
    ];
} 

echo json_encode($message);
