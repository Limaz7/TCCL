<?php

session_start();

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

$eoq = $_POST['eoq'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$hash = password_hash($senha, PASSWORD_ARGON2I);

if ($nome == $dados['nome']) {
    $_SESSION['mensagem'] = [
        0 => 'Já existe um usuário com esse nome! Tente se cadastrar com outro nome.',
        1 => '#c62828 red darken-3'
    ];
    header('location: formcaduser.php');
    exit();
}

if ($email === $dados['email']) {
    $_SESSION['mensagem'] = [
        0 => 'O email já existe, tente se cadastrar com outro email.',
        1 => '#c62828 red darken-3'
    ];
    header('location: formcaduser.php');
    die();
} else {

    if ($eoq == 3) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
        VALUES ('$nome', '$email', '$hash', '$eoq', '2')";
        $resultInsert = executarSQL($conexao, $sql);

        if ($resultInsert) {
            $_SESSION['mensagem'] = [
                0 => 'Usuário cadastrado com sucesso!',
                1 => '#558b2f light-green darken-3'
            ];
            header('location: ../index.php');
            exit();
        } else {
            $_SESSION['mensagem'] = [
                0 => 'Não foi possível cadastrar o usuário',
                1 => '#c62828 red darken-3'
            ];
            header('location: formcaduser.php');
            exit();
        }
    } elseif ($eoq == 2) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
    VALUES ('$nome', '$email', '$hash', '$eoq', '1')";
        $resultInsert = executarSQL($conexao, $sql);

        if ($resultInsert) {
            $_SESSION['mensagem'] = [
                0 => 'Usuário cadastrado com sucesso!',
                1 => '#558b2f light-green darken-3'
            ];
            header('location: ../index.php');
            exit();
        } else {
            $_SESSION['mensagem'] = [
                0 => 'Não foi possível cadastrar o usuário',
                1 => '#c62828 red darken-3'
            ];
            header('location: formcaduser.php');
            exit();
        }
    }
}
