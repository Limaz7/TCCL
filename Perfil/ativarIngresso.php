<?php

include("../conexao.php");
$conexao = conectar();

$idIngresso = $_GET['id_ingresso'];

$selectIngressoCad = "SELECT status FROM ingressos_cadastrados WHERE id_ingresso='$idIngresso'";
$execResultSelectIng = executarSQL($conexao, $selectIngressoCad);
$Result = mysqli_fetch_assoc($execResultSelectIng);

session_start();

if ($Result['status'] == 0) {

    $sql = "UPDATE ingressos_cadastrados SET status = 1 WHERE id_ingresso='$idIngresso'";
    $updateIngresso = executarSQL($conexao, $sql);

    if ($updateIngresso) {
        $_SESSION['mensagem'] = [
            0 => "Ingresso ativado com sucesso!",
            1 => "#558b2f light-green darken-3"
        ];
    } else {
        $_SESSION['mensagem'] = [
            0 => "Não foi possível ativar o ingresso!",
            1 => "#c62828 red darken-3"
        ];
    }
} else {

    $sql = "UPDATE ingressos_cadastrados SET status = 0 WHERE id_ingresso='$idIngresso'";
    $updateIngresso = executarSQL($conexao, $sql);

    if ($updateIngresso) {
        $_SESSION['mensagem'] = [
            0 => "Ingresso desativado com sucesso!",
            1 => "#558b2f light-green darken-3"
        ];
    } else {
        $_SESSION['mensagem'] = [
            0 => "Não foi possível desativar o ingresso!",
            1 => "#c62828 red darken-3"
        ];
    }
}

header('location: vizuIngressosCad.php');
exit();
