<?php

include_once "../conexao.php";
$conexao = conectar();

$eoq = $_POST['eoq'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$hash = password_hash($senha, PASSWORD_ARGON2I);

if($eoq == 3){
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
        VALUES ('$nome', '$email', '$hash', '$eoq', '2')";
    executarSQL($conexao, $sql);
    header('location: ../index.php');
    die();
} elseif($eoq == 2) {
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
    VALUES ('$nome', '$email', '$hash', '$eoq', '1')";
    executarSQL($conexao, $sql);
    header("location: ../index.php");
    die();
}
