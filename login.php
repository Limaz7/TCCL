<?php

include "cruds/conexao.php";
$conexao = conectar();

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$_SESSION['nome'] = $nome;

$sql = "SELECT * FROM usuario WHERE email='$email'";

$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

$hash = $dados['senha'];

if(password_verify($senha, $hash)){
    if ($dados['empresa'] == true){
        header("location: iniempresa.php");
    }
    if ($dados['empresa'] == false){
        header('location: inipessoa.php');
    }
}