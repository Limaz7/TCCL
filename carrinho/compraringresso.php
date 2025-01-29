<?php

/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../rec-senha/PHPMailer/src/Exception.php';
require '../rec-senha/PHPMailer/src/PHPMailer.php';
require '../rec-senha/PHPMailer/src/SMTP.php'; */

include('../conexao.php');
$conexao = conectar();

session_start();

// Busca todos os ingressos do carrinho do usuário que ainda não foram pagos
$selectCart = "SELECT * FROM carrinhos WHERE id_usuario=" . $_SESSION['user'][0] . " AND pago=0";
$execSelCart = executarSQL($conexao, $selectCart);

if (mysqli_num_rows($execSelCart) == 0) {
    header('location: cart.php');
    die();
}

$cart = mysqli_fetch_assoc($execSelCart);
$cartId = $cart['id_carrinho'];

// Buscar todos os ingressos no carrinho
$selectIngressos = "SELECT cic.id_ingresso, ica.estoque, ica.estoque 
                    FROM carrinho_ingressos_cadastrados cic
                    INNER JOIN ingressos_cadastrados ica 
                    ON cic.id_ingresso = ica.id_ingresso
                    INNER JOIN carrinhos c
                    ON c.id_carrinho = cic.id_carrinho
                    WHERE cic.id_carrinho='$cartId'";

$execSelIngressos = executarSQL($conexao, $selectIngressos);

$ingressos = [];
while ($ingresso = mysqli_fetch_assoc($execSelIngressos)) {
    $ingressos[] = $ingresso;
}

// Verifica se há estoque para todos os ingressos antes de atualizar qualquer coisa
foreach ($ingressos as $ingresso) {
    if ($ingresso['quantidade'] > $ingresso['estoque']) {
        $_SESSION['mensagem'] = [
            0 => 'Estoque insuficiente para um ou mais ingressos.',
            1 => '#c62828 red darken-3'
        ];
        header('location: cart.php');
        die();
    }
}

// Se passou pela verificação, atualizar o estoque de todos os ingressos
foreach ($ingressos as $ingresso) {
    $nova_qtd = $ingresso['estoque'] - $ingresso['quantidade'];
    $updateEstoque = "UPDATE ingressos_cadastrados SET estoque='$nova_qtd' WHERE id_ingresso=" . $ingresso['id_ingresso'];
    executarSQL($conexao, $updateEstoque);
}


// Atualizar o carrinho para pago
date_default_timezone_set('America/Sao_Paulo');
$data = new DateTime('now');
$agora = $data->format('Y-m-d H:i:s');

$idUser = $_SESSION['user'][0];

$updateCart = "UPDATE carrinhos SET pago=1, data='$agora' WHERE id_usuario='$idUser' AND cart_session=" . $_SESSION['cart'];
$execUpdtCart = executarSQL($conexao, $updateCart);

if ($execUpdtCart) {
    $_SESSION['mensagem'] = [
        0 => 'Todos os ingressos foram comprados com sucesso!',
        1 => '#558b2f light-green darken-3'
    ];
} else {
    $_SESSION['mensagem'] = [
        0 => 'Não foi possível completar a compra.',
        1 => '#c62828 red darken-3'
    ];
}

header("location: ../index.php");
