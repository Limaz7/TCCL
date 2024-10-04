<?php

session_start();

include_once "../conexao.php";
$conexao = conectar();

$preco = $_POST['preco'];

$sql = "INSERT INTO ingressos (valor, id_evento) VALUES ('$preco', ' " . $_SESSION['evento'][0] . "')";
executarSQL($conexao, $sql);

header("location: ../inicial.php");