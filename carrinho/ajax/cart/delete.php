<?php

session_start();
require '../../../conexao.php';
$conexao = conectar();

if ($_POST) {
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

    $cart = "SELECT c.id_carrinho, c.cart_session, c.quantidade, cic.id_ingresso 
         FROM carrinhos c 
         INNER JOIN carrinho_ingressos_cadastrados cic 
         ON cic.id_carrinho = c.id_carrinho
         WHERE c.cart_session = " . $_SESSION['cart'] . " AND c.id_carrinho = $index";
    $cart = executarSQL($conexao, $cart);

    foreach ($cart as $Sh) {
    }


    $prodId = strip_tags($Sh['id_ingresso']);
    $quantidade = strip_tags($Sh['quantidade']);

    $Product = "SELECT id_ingresso, estoque
         FROM ingressos_cadastrados WHERE id_ingresso = $prodId";
    $Product = executarSQL($conexao, $Product);

    foreach ($Product as $Show) {
    }

    $productId = strip_tags($Show['id_ingresso']);
    $productStock = strip_tags($Show['estoque']);
    $stock = $productStock + $quantidade;

    $update = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$productId'";
    executarSQL($conexao, $update);

    $deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_carrinho = $index";
    executarSQL($conexao, $deleteCIC);

    $delete = "DELETE FROM carrinhos WHERE id_carrinho = $index";
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
} elseif ($_GET) {

    $session = $_GET['cart_session'];
    $cartId = $_GET['cart_id'];
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    $getFilters = array_map("strip_tags", $get);
    //$index = filter_input(INPUT_GET, 'cart_id', FILTER_SANITIZE_NUMBER_INT);

    usleep(50000);

    if (!$_SESSION['cart'] || empty($_SESSION['cart'])) {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possível excluir esse produto',
            1 => '#c62828 red darken-3'
        ];
        header('location: ../../../perfil/vizuIngressosBuy.php');
        exit();
    }

    $cart = "SELECT c.id_carrinho, c.cart_session, c.quantidade, cic.id_ingresso 
         FROM carrinhos c 
         INNER JOIN carrinho_ingressos_cadastrados cic
         WHERE c.cart_session = '$session' AND c.id_carrinho = '$cartId'";
    $cart = executarSQL($conexao, $cart);
    $resultSelect = mysqli_fetch_assoc($cart);
    var_dump($resultSelect);

    $prodId = strip_tags($resultSelect['id_ingresso']);
    $quantidade = strip_tags($resultSelect['quantidade']);

    $Product = "SELECT id_ingresso, estoque
         FROM ingressos_cadastrados WHERE id_ingresso = '$prodId'";
    $Product = executarSQL($conexao, $Product);

    foreach ($Product as $Show) {
    }

    $productId = strip_tags($Show['id_ingresso']);
    $productStock = strip_tags($Show['estoque']);
    $stock = $productStock + $quantidade;

    $update = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$productId'";
    executarSQL($conexao, $update);

    $deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_carrinho = $cartId";
    executarSQL($conexao, $deleteCIC);

    $delete = "DELETE FROM carrinhos WHERE id_carrinho = $cartId";
    executarSQL($conexao, $delete);

    if ($delete) {
        $_SESSION['mensagem'] = [
            0 => 'O pedido foi cancelado.',
            1 => '#558b2f light-green darken-3'
        ];
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possivel cancelar o pedido.',
            1 => '#c62828 red darken-3'
        ];
    }

    header('location: ../../../perfil/vizuIngressosBuy.php');
    exit;
}
