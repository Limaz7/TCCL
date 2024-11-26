<?php

include_once "../conexao.php";
$conexao = conectar();

$info = $_POST['info'];
$valor = $_POST['valor'];
$quant = $_POST['quant'];
$id = $_POST['id'];

$sql = "UPDATE ingressos_cadastrados SET informacao='$info', valor='$valor',
        quantidade='$quant' WHERE id_ingresso='$id'";
executarSQL($conexao, $sql);

header('location: vizuIngressos.php');


?>