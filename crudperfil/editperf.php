<?php

include_once "../conexao.php";
$conexao = conectar();

session_start();
session_regenerate_id(true);

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "UPDATE usuarios SET nome='$nome', email='$email',
        WHERE id_usuario=" . $_SESSION['user'][0];
executarSQL($conexao, $sql);

header('location: vizuperfil.php');
?>