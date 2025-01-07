<?php

include_once "../conexao.php";
$conexao = conectar();

$info = $_POST['info'];
$valor = $_POST['valor'];
$quant = $_POST['quant'];
$id = $_POST['id'];

$sql = "UPDATE ingressos_cadastrados SET desc_ingresso='$info', valor='$valor',
        estoque='$quant' WHERE id_ingresso='$id'";
executarSQL($conexao, $sql);

session_start();

$_SESSION['mensagem'][0] = 'Ingresso editado com sucesso!';
$_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

header('location: ../Perfil/vizuIngressosCad.php');
