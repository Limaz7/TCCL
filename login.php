<?php

include "conexao.php";
$conexao = conectar();

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email'";

$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

if (!isset($dados['email'])) {
    $_SESSION['mensagem'] = [
        0 => 'Senha ou email incorretos! Tente logar novamente.',
        1 => '#c62828 red darken-3'
    ];


    header('location: telalogin.php');
    exit();
} else {

    $hash = $dados['senha'];

    if (password_verify($senha, $hash)) {
        if ($dados['tipo_usuario'] == 3 and $dados['cod_ativacao'] == 1) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            $_SESSION['user'][2] = $dados['tipo_usuario'];
            header("location: inicial.php");
        } elseif ($dados['cod_ativacao'] == 2) {

            $_SESSION['mensagem'] = [
                0 => "Olá {$dados['nome']} você precisa estar aceito para entrar no sistema! Sua solicitação está em análise.<br>",
                1 => '#ffd740 amber accent-2'
            ];


            header('location: index.php');
            exit();
        } elseif ($dados['cod_ativacao'] == 3) {

            $_SESSION['mensagem'] = [
                0 => "Olá {$dados['nome']} Você não pode entrar no sistema, sua solicitação foi negada<br>",
                1 => '#c62828 red darken-3'
            ];


            header('location: index.php');
            exit();
        }
        if ($dados['tipo_usuario'] == 2 and $dados['cod_ativacao'] == 1) {

            $_SESSION['user'] = [
                0 => $dados['id_usuario'],
                1 => $dados['nome'],
                2 => $dados['tipo_usuario']
            ];


            header('location: index.php');
            exit();
        }
        if ($dados['tipo_usuario'] == 1 and $dados['cod_ativacao'] == 1) {
            $_SESSION['user'] = [
                0 => $dados['id_usuario'],
                1 => $dados['nome'],
                2 => $dados['tipo_usuario']
            ];


            header('location: telasadmin/listarUsers.php');
            exit();
        }
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Senha ou email incorretos! Tente logar novamente.',
            1 => '#c62828 red darken-3'
        ];


        header('location: telalogin.php');
    }
}
