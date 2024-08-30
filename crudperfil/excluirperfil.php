<?php

include "../conexao.php";
$conexao = conectar();

session_start();
session_regenerate_id(true);

$sql = "DELETE FROM usuarios WHERE id_usuario=". $_SESSION['user'][0];
executarSQL($conexao, $sql);
header('location: ../index.php');