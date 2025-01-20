<?php

include("../conexao.php");
$conexao = conectar();

$nome = $_POST['nome'];
$email = $_POST['email'];
$cod_atv = $_POST['cod_atv'];
$id = $_POST['id'];

$sql = "UPDATE usuarios SET nome='$nome', email='$email', cod_ativacao='$cod_atv' WHERE id_usuario='$id'";
$resultUpdate = executarSQL($conexao, $sql);

if($nome != $resultUpdate['nome']){
    unset($_SESSION['user'][1]);
    $_SESSION['user'][1] = $resultUpdate['nome'];
}

if ($resultUpdate) {
    $_SESSION['mensagem'] = [
        0 => 'Perfil editado com sucesso!',
        1 => '#558b2f light-green darken-3'
    ];
} else {
    $_SESSION['mensagem'] = [
        0 => 'Não foi possível editar o perfil.',
        1 => '#c62828 red darken-3'
    ];
}

header('location: ../telasAdmin/listarUsers.php');