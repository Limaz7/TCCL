<?php

session_start();
require '../../../conexao.php';
$conexao = conectar();

$message = null;
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postFilters = array_map("strip_tags", $post);

foreach ($postFilters as $index => $value) {
    //Tirou os traços e tranformou em vazio.
    $product = str_replace('_', ' ', $value);

    usleep(50000);

    $Product = "SELECT i.*, e.*
    FROM ingressos_cadastrados i INNER JOIN eventos e ON i.id_evento = e.id_evento WHERE nome_ingresso = '$product'";
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
            'message' => 'Ops! Produto sem estoque.',
            'status' => 'error',
            'redirect' => ''
        ];
        echo json_encode($message);
        return;
    }

    //Verifica se o produto foi ou nao cadastrado para esta sessão
    $Cart = "SELECT id_carrinho, cart_session, quantidade
    FROM carrinhos WHERE cart_session = " . $_SESSION['cart'] . "";
    $Cart = executarSQL($conexao, $Cart);

    $lines = mysqli_fetch_row($Cart);

    foreach ($Cart as $Sh) {
    }

    if ($lines == 0) {
        $stock = $product_stock - 1;

        $token = bin2hex(random_bytes(10));

        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime('now');
        $agora = $data->format('Y-m-d H:i:s');

        $Create = "INSERT INTO carrinhos (id_usuario, ticket,
        quantidade, ingresso_valor, estoque, cart_total, cart_session, data)
        VALUES ('" . $_SESSION['user'][0] . "', '$token', 1,
        '$product_price', '$stock', '$product_price', '" . $_SESSION['cart'] . "', '$agora')";
        $createResult = executarSQL($conexao, $Create);
        $UltimoIDCarrinho = mysqli_insert_id($conexao);

        $CIC = "INSERT INTO carrinho_ingressos_cadastrados (id_ingresso, id_carrinho)
                VALUES ('$product_id', '$UltimoIDCarrinho')";
        executarSQL($conexao, $CIC);

        //Update no estoque desse produto
        $stock = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $stock);

        if ($createResult) {
            $message = [
                'message' => 'O produto ' . $product . ' foi adicionado ao carrinho.',
                'status' => 'success',
                'redirect' => ''
            ];
            echo json_encode($message);
            die();
        } else {
            $message = [
                'message' => 'Não foi possivel adicionar o produto ao carrinho.',
                'status' => 'error',
                'redirect' => ''
            ];
            echo json_encode($message);
            die();
        }
    } else {

        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime('now');
        $agora = $data->format('Y-m-d H:i:s');

        $cart_quantity = strip_tags($Sh['quantidade'] + 1);
        $cart_id = strip_tags($Sh['id_carrinho']);
        $value = number_format($product_price * $cart_quantity, 2, '.', '');
        $stock = $product_stock - 1;

        $update = "UPDATE carrinhos c 
        INNER JOIN carrinho_ingressos_cadastrados cic ON cic.id_carrinho = c.id_carrinho
        SET c.data = '$agora',
            c.quantidade = '$cart_quantity',
            c.estoque = '$stock',
            c.ingresso_valor = '$product_price',
            c.cart_total = '$value'
        WHERE c.id_carrinho = '$cart_id'
        AND c.cart_session = " . $_SESSION['cart'];
        $updateResult = executarSQL($conexao, $update);

        //Update no estoque desse produto
        $stock = "UPDATE ingressos_cadastrados SET estoque = $stock WHERE id_ingresso = '$product_id'";
        executarSQL($conexao, $stock);

        if ($updateResult) {
            $message = [
                'message' => 'O produto ' . $product . ' foi atualizado no carrinho.',
                'status' => 'success',
                'redirect' => ''
            ];
            echo json_encode($message);
            die();
        } else {
            $message = [
                'message' => 'Não foi possivel atualizar o produto ao carrinho.',
                'status' => 'error',
                'redirect' => ''
            ];
            echo json_encode($message) .
                die();
        }
    }

    echo json_encode($message);
}
