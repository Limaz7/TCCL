<?php

include_once "../conexao.php";
$conexao = conectar();

$info = $_POST['info'];
$valor = $_POST['valor'];
$quant = $_POST['quant'];
$id = $_POST['id'];

$sql = "UPDATE ingressos_cadastrados SET desc_ingresso='$info', valor='$valor',
        estoque='$quant' WHERE id_ingresso='$id'";
$resultEditIng = executarSQL($conexao, $sql);

session_start();

if ($resultEditIng) {
        $_SESSION['mensagem'][0] = 'Ingresso editado com sucesso!';
        $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';
} else {
        $_SESSION['mensagem'][0] = "Não foi possivel editar o ingresso.";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
}

if ($_SESSION['user'][2] == 3) {
        header('location: ../Perfil/vizuIngressosCad.php');
        exit();
} elseif ($_SESSION['user'][2] == 1) {
        header('location:  vizuIngressos.php');
        exit();
}
