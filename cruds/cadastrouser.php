<?php

include_once "../conexao.php";
$conexao = conectar();

$eoq = $_POST['eoq'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$hash = password_hash($senha, PASSWORD_ARGON2I);

if($eoq == 1){
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
        VALUES ('$nome', '$email', '$hash', '$eoq')";
    executarSQL($conexao, $sql);
    header('location: ../index.php');
} else {
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
    VALUES ('$nome', '$email', '$hash', '$eoq')";
    executarSQL($conexao, $sql);
    header("location: ../index.php");
}
