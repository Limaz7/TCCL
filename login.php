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
    echo "Não existe esse email no banco de dados! Tente logar novamente
    <a href='index.php'>Login</a>";
    die();
}
else{

    $hash = $dados['senha'];

    if (password_verify($senha, $hash)) {
        if ($dados['tipo_usuario'] == 3 and $dados['cod_ativacao'] == 1) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            $_SESSION['user'][3] = $dados['tipo_usuario'];
            header("location: inicial.php");
        } elseif ($dados['cod_ativacao'] == 2) {
            echo "Olá {$dados['nome']} você precisa estar aceito para entrar
            no sistema! Sua solicitação está em análise.<br>";
            echo "<a href='index.php'>Voltar</a>";
        } elseif ($dados['cod_ativacao'] == 3) {
            echo "Olá {$dados['nome']} Você não pode entrar no sistema,
            sua solicitação foi negada<br>";
            echo "<a href='index.php'>Voltar</a>";
        }
        if ($dados['tipo_usuario'] == 2 and $dados['cod_ativacao'] == 1) {

            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            $_SESSION['user'][3] = $dados['tipo_usuario'];
            header('location: inicial.php');
        }
        if ($dados['tipo_usuario'] == 1 and $dados['cod_ativacao'] == 1) {
            $_SESSION['user'][0] = $dados['id_usuario'];
            $_SESSION['user'][1] = $dados['nome'];
            $_SESSION['user'][2] = $dados['tipo_usuario'];
            header('location: telasadmin/listarUsers.php');
        }
    } else {
        echo "A senha está incorreta! Tente logar
            novamente. <br> <a href='index.php'>Voltar</a>";
    }
    
}