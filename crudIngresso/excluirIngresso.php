<?php

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_ingresso'];

$sql = "DELETE FROM ingressos_cadastrados WHERE id_ingresso='$id'";
executarSQL($conexao, $sql);

header('location: vizuIngressos.php');