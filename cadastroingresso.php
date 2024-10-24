<?php

include ("conexao.php");
$conexao = conectar();

$id_ev = $_POST['id_ev'];
$desc = $_POST['desc'];
$valor = $_POST['valor'];
$qtd = $_POST['qtd'];

$sql = "INSERT INTO ingressos_cadastrados(id_evento, descricao, valor, quantidade)
        VALUES ('$id_ev', '$desc', $valor, '$qtd')";

executarSQL($conexao, $sql);

header("location: informacoes.php?id_evento=$id_ev");