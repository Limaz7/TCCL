<?php

include "../conexao.php";
$conexao = conectar();

session_start();

$sql1 = "SELECT * FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql1);
$dados = mysqli_fetch_assoc($result);

$pastaImg = "../imagens";

$id = $dados['id_evento'];

unlink($pastaImg . $dados['imagem']);

$sql_ingresso = "DELETE FROM ingressos WHERE id_evento = '$id'";
executarSQL($conexao, $sql_ingresso);

$sql_endere = "DELETE FROM enderecos WHERE id_evento = '$id'";
executarSQL($conexao, $sql_endere);

$sql_even = "DELETE FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
executarSQL($conexao, $sql_even);

$sql_info_ingresso = "DELETE FROM info_ingressos WHERE id_usuario=" . $_SESSION['user'][0];
executarSQL($conexao, $sql_info_ingresso);

$sql_user = "DELETE FROM usuarios WHERE id_usuario=". $_SESSION['user'][0];
executarSQL($conexao, $sql_user);

header('location: ../index.php');