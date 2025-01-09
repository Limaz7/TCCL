<?php

include ("../conexao.php");
$conexao = conectar();

$nome = $_POST['nome'];
$email = $_POST['email'];
$cod_atv = $_POST['cod_atv'];
$id = $_POST['id'];

$sql = "UPDATE usuarios SET nome='$nome', email='$email', cod_ativacao='$cod_atv' WHERE id_usuario='$id'";
executarSQL($conexao, $sql);

$_SESSION['mensagem'][0] = "Perfil editado com sucesso!";
$_SESSION['mensagem'][1] = "#558b2f light-green darken-3";

header('location: ../telasAdmin/listarUsers.php');