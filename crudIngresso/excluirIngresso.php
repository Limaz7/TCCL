<?php

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_ingresso'];

$selectCart = "SELECT * FROM carrinhos c INNER JOIN carrinho_ingressos_cadastrados cic ON c.id_carrinho = cic.id_carrinho WHERE cic.id_ingresso='$id'";
$execSelCart = executarSQL($conexao, $selectCart);
$result = mysqli_fetch_row($execSelCart);

if ($result){
    $_SESSION['mensagem'] = [
        0 => 'Você não pode excluir esse ingresso, porque um participante ja efetuou a compra dele.',
        1 => '#c62828 red darken-3',
    ];
    
    header('location: ../Perfil/vizuIngressosCad.php');
    die();
}

$deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_ingresso='$id'";
executarSQL($conexao, $deleteCIC);

$sql_inBuy = "DELETE c FROM carrinhos c INNER JOIN carrinho_ingressos_cadastrados cic ON c.id_carrinho = cic.id_carrinho INNER JOIN ingressos_cadastrados ica ON cic.id_ingresso = ica.id_ingresso WHERE ica.id_ingresso='$id'";
$deleteInBuy = executarSQL($conexao, $sql_inBuy);

$sql = "DELETE FROM ingressos_cadastrados WHERE id_ingresso='$id'";
$deleteinCad = executarSQL($conexao, $sql);

session_start();

if ($deleteInBuy && $deleteinCad) {
    $_SESSION['mensagem'][0] = 'Ingresso excluido com sucesso!';
    $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';
} else {
    $_SESSION['mensagem'][0] = "Não foi possivel excluir o ingresso.";
    $_SESSION['mensagem'][1] = "#c62828 red darken-3";
}

if ($_SESSION['user'][2] == 3) {
    header('location: ../Perfil/vizuIngressosCad.php');
    exit();
} elseif ($_SESSION['user'][2] == 1) {
    header('location:  vizuIngressos.php');
    exit();
}

header('location: ../Perfil/vizuIngressosCad.php');
