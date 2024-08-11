<?php

include "conexao.php";
$conexao = conectar();

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE email='$email'";

$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

if ($email != $dados['email']) {
    echo "O email esta incorreto! Tente logar novamente
    <a href='index.php'>Login</a>";
} else {

    $hash = $dados['senha'];

    if (password_verify($senha, $hash)) {
        if ($dados['empresa'] == true) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            header("location: iniempresa.php");
        }
        if ($dados['empresa'] == false) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            header('location: inipessoa.php');
        }
    }
}
