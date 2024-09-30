<?php

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
    echo "Já existe um usuário com esse nome! Tente se cadastrar com outro nome.<br>";
    echo "<a href='formcaduser.php'>Voltar</a>";
    die();
}

if ($email === $dados['email']) {
    echo "O email já existe, tente se cadastrar com outro email.<br>";
    echo "<a href='formcaduser.php'>Voltar</a>";
    die();
} else {

    if ($eoq == 3) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
        VALUES ('$nome', '$email', '$hash', '$eoq', '2')";
        executarSQL($conexao, $sql);
        header('location: ../index.php');
        die();
    } elseif ($eoq == 2) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cod_ativacao) 
    VALUES ('$nome', '$email', '$hash', '$eoq', '1')";
        executarSQL($conexao, $sql);
        header("location: ../index.php");
        die();
    }
}
