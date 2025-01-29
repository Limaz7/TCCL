<?php

include('conexao.php');
$conexao = conectar();

session_start();

$pagina = $_GET['pagina'];
$idEvento = $_GET['id_evento'];

$selectCart = "SELECT * FROM carrinhos WHERE id_usuario=" . $_SESSION['user'][0] . " AND pago=0";
$execSelCart = executarSQL($conexao, $selectCart);
$rowCart = mysqli_fetch_row($execSelCart);

if ($_SESSION['user'][2] == 1){
    session_start();
    session_destroy();

    header('location: telalogin.php');
    die();
}

if (isset($rowCart)) {
    $_SESSION['mensagem'] = [
        0 => 'Você não pode deslogar do sistema se possuir um ingresso no carrinho',
        1 => '#c62828 red darken-3'
    ];


    header("location: $pagina?id_evento=$idEvento");
    exit();
} else {
    session_start();
    session_destroy();

    header('location: telalogin.php');
}
