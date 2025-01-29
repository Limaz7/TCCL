<?php

session_start();
require '../../../conexao.php';
$conexao = conectar();

$message = null;
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$minus = filter_input(INPUT_GET, 'minus', FILTER_DEFAULT);
$plus = filter_input(INPUT_GET, 'plus', FILTER_DEFAULT);

$postFilters = array_map("strip_tags", $post);

foreach ($postFilters as $index => $value) {
}
usleep(50000);

if (!$_SESSION['cart'] || empty($_SESSION['cart'])) {
    $message = [
        'message' => 'Não foi possível atualizar esse produto',
        'status' => 'error',
        'redirect' => ''
    ];

    echo json_encode($message);
    return;
}

$cart = "SELECT 
            c.id_carrinho, 
            c.cart_session, 
            c.quantidade,
            cic.id_ingresso
         FROM carrinhos c
         INNER JOIN carrinho_ingressos_cadastrados cic
         ON cic.id_carrinho = c.id_carrinho
         WHERE c.cart_session = " . $_SESSION['cart'] . " AND c.id_carrinho = $index";
$cart = executarSQL($conexao, $cart);

$lines = mysqli_fetch_row($cart);

if ($lines == 0) {
    $message = [
        'message' => "Este produto ja foi removido do pedido",
        'status' => 'info',
        'redirect' => ''
    ];

    echo json_encode($message);
    return;
} else {

    foreach ($cart as $Sh) {
    }
    $product_id = strip_tags($Sh['id_ingresso']);
    $qtd = strip_tags($Sh['quantidade']);

    if (!empty($plus)) {
        $cart_quantity = $qtd + 1;
    } else {
        $cart_quantity = $qtd - 1;
    }

    $Product = "SELECT id_ingresso, estoque, valor
         FROM ingressos_cadastrados WHERE id_ingresso = $product_id";
    $Product = executarSQL($conexao, $Product);

    foreach ($Product as $Show) {
    }

    $product_stock = strip_tags($Show['estoque']);
    $product_price = strip_tags($Show['valor']);
    $value = $product_price * $cart_quantity;

    if ($plus and !empty($plus)) {
        $stock = $product_stock - 1;
    } else {
        $stock = $product_stock + 1;
    }

    //Quantidade no carrinho for igual a zero
    if ($cart_quantity == 0) {
        $update = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $update);

        $deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_carrinho = $index";
        $execDelCIC = executarSQL($conexao, $deleteCIC);

        $delete = "DELETE FROM carrinhos WHERE id_carrinho = $index";
        $execDelCart = executarSQL($conexao, $delete);

        if ($execDelCart && $execDelCIC) {
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
    }

    //Verifica se o produto tem estoque
    if ($product_stock == 0 and empty($minus)) {
        $message = [
            'message' => "Ops, temos apenas {$qtd} Un. desse estoque",
            'status' => 'error'
        ];

        echo json_encode($message);
        return;
    } else {
        $update = "UPDATE carrinhos c 
                   INNER JOIN carrinho_ingressos_cadastrados cic 
                   ON c.id_carrinho = cic.id_carrinho
                   SET c.quantidade = $cart_quantity, c.estoque = $stock,
        c.ingresso_valor = $product_price, cart_total  = $value
        WHERE c.id_carrinho = $index AND cic.id_ingresso = $product_id AND cart_session =" . $_SESSION['cart'];
        executarSQL($conexao, $update);

        $update = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $update);
    }
}

echo json_encode($message);
