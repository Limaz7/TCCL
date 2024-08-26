<?php

include "conexao.php";
$conexao = conectar();

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email'";

$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);   

if ($email != $dados['email']) {
    echo "O email esta incorreto! Tente logar novamente
    <a href='index.php'>Login</a>";
} else {

    $hash = $dados['senha'];

    if (password_verify($senha, $hash)) {
        if ($dados['cod_ativacao'] == 1) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            header("location: iniempresa.php");
        } elseif ($dados['cod_ativacao'] == 2){
            echo "Olá {$dados['nome']} você precisa estar aceito para entrar
            no sistema! Sua solicitação está em análise.";
            echo "<a href='index.php'>Voltar</a>";
        } elseif ($dados['cod_ativacao'] == 3){
            echo "Olá {$dados['nome']} Você não pode entrar no sistema,
            sua solicitação foi negada";
        }
        if ($dados['cod_ativacao'] == 1) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            header('location: inipessoa.php');
        }
    }
}
