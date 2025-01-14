<?php

session_start();

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
    $result_DelInc = executarSQL($conexao, $delete_inc);

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    $result_DelUser = executarSQL($conexao, $delete_user);

    if ($result_DelInc && $result_DelUser) {
        $_SESSION['mensagem'][0] = "Usuário excluido com sucesso!";
        $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
    } else {
        $_SESSION['mensagem'][0] = "Não foi possivel excluir o usuario!";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
    }

} elseif ($dados['tipo_usuario'] == 3) {

    $delete_incads = "DELETE FROM ingressos_cadastrados WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_incads);

    unlink($pasta . $img['imagem']);

    $delete_eve = "DELETE FROM eventos WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_eve);

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_user);

    if ($result_DelInc && $result_DelUser) {
        $_SESSION['mensagem'][0] = "Usuário excluido com sucesso!";
        $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
    } else {
        $_SESSION['mensagem'][0] = "Não foi possivel excluir o usuario!";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
    }

}

header('location: ../telasAdmin/listarUsers.php');
exit();
