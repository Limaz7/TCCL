<?php

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_ingresso'];

$sql_inBuy = "DELETE FROM ingressos_comprados WHERE id_ingresso='$id'";
executarSQL($conexao, $sql_inBuy);

$sql = "DELETE FROM ingressos_cadastrados WHERE id_ingresso='$id'";
executarSQL($conexao, $sql);

session_start();

$_SESSION['mensagem'][0] = 'Ingresso excluido com sucesso!';
$_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

header('location: ../Perfil/vizuIngressosCad.php');