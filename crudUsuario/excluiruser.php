<?php

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_usuario'];
$pasta = "../imagens";

$selectImg = "SELECT imagem FROM eventos";
$result0 = executarSQL($conexao, $selectImg);
$img = mysqli_fetch_assoc($result0);

$select = "SELECT * FROM usuarios WHERE id_usuario='$id'";
$result = executarSQL($conexao, $select);
$dados = mysqli_fetch_assoc($result);

if ($dados['tipo_usuario'] == 2) {

    $delete_inc = "DELETE FROM ingressos_comprados WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_inc);

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_user);

    header('location: ../telasAdmin/listarUsers.php');

} elseif ($dados['tipo_usuario'] == 3) {

    $delete_incads = "DELETE FROM ingressos_cadastrados WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_incads);

    unlink($pasta . $img['imagem']);

    $delete_eve = "DELETE FROM eventos WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_eve);

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_user);

    header('location: ../telasAdmin/listarUsers.php');
}
