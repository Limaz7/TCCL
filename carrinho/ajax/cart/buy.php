<?php

session_start();
require '../../../conexao.php';
$conexao = conectar();

$message = null;
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postFilters = array_map("strip_tags", $post);

foreach ($postFilters as $index => $value) {
    //Tirou os traços e tranformou em vazio... Transformou as letras maiusculas em minusculas
    $product = str_replace('_', ' ', $index);var_dump($index);

    usleep(50000);

    if (empty($_SESSION['cart']) || !$_SESSION['cart']) {
        $_SESSION['cart'] = rand(100000, 1000000000);
    }

    $Product = "SELECT i.*, e.*
    FROM ingressos_cadastrados i INNER JOIN eventos e ON i.id_evento = e.id_evento WHERE nome_ingresso = '$product' AND status = 1";
    $Product = executarSQL($conexao, $Product);

    foreach ($Product as $show) {
    }

    if ($show) {

        $product_id = $show['id_ingresso'];
        $product_cover = $show['imagem'];
        $product_stock = $show['estoque'];
        $product_name = $show['nome_ingresso'];
        $product_price = $show['valor'];
    } else {
        echo "Produto não encontrado";
    }

    //Verifica se o produto tem estoque

    if ($product_stock == 0) {
        $message = [
            'message' => 'Ops! Produto sem estoque',
            'status' => 'error',
            'redirect' => ''
        ];
        echo json_encode($message);
        return;
    }

    //Verifica se o produto foi ou nao cadastrado para esta sessão
    $Cart = "SELECT cart_id, cart_session, cart_status, id_ingresso, quantidade
    FROM ingressos_comprados WHERE cart_session = " . $_SESSION['cart'] . " AND cart_status = 1 AND id_ingresso = '$product_id'";
    $Cart = executarSQL($conexao, $Cart);

    $lines = mysqli_fetch_row($Cart);

    foreach ($Cart as $Sh) {
    }

    if ($lines == 0) {
        $stock = $product_stock - 1;

        $token = bin2hex(random_bytes(10));

        $Create = "INSERT INTO ingressos_comprados (id_ingresso, id_usuario, ticket,
        quantidade, cart_valor, cart_total, cart_status, cart_session)
        VALUES ('$product_id', '" . $_SESSION['user'][0] . "', '$token', 1,
        '$product_price', '$product_price', 1, '" . $_SESSION['cart'] . "')";
        executarSQL($conexao, $Create);

        //Update no estoque desse produto
        $stock = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $stock);

        if ($Create) {
            $_SESSION['mensagem'][0] = "OO produto {$product} foi adicionado ao carrinho";
            $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
            echo json_encode(['message' => $_SESSION['mensagem'][0], 'status' => 'success']);
            die();
        } else {
            $message = [
                'message' => 'Não foi possivel adicionar o produto ao carrinho',
                'status' => 'error',
                'redirect' => ''
            ];
        }
    } else {
        $cart_quantity = strip_tags($Sh['quantidade'] + 1);
        $cart_id = strip_tags($Sh['cart_id']);
        $value = number_format($product_price * $cart_quantity, 2, '.', '');
        $stock = $product_stock - 1;
        var_dump($_SESSION['cart'], $product_id, $cart_id);

        $update = "UPDATE ingressos_comprados SET quantidade = '$cart_quantity', estoque = '$stock', cart_valor = '$product_price', cart_total = '$value'
        WHERE cart_id = '$cart_id' AND id_ingresso = '$product_id' AND cart_session = " . $_SESSION['cart'];
        executarSQL($conexao, $update);

        //Update no estoque desse produto
        $stock = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $stock);

        if ($update) {
            $_SESSION['mensagem'][0] = "O produto {$product} foi atualizado ao carrinho";
            $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
            die();
        } else {
            $message = [
                'message' => 'Não foi possivel atualizar o produto ao carrinho',
                'status' => 'error',
                'redirect' => ''
            ];
        }
    }

    echo json_encode($message);
}
