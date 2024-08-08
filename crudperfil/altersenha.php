<?php

session_start();
session_regenerate_id(true);

include "../conexao.php";
$conexao = conectar();

$sql_select = "SELECT senha FROM usuario WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql_select);
$dados = mysqli_fetch_assoc($result);

$senhaAtual = $_POST['senhaAtual'];
$novaSenha = $_POST['novSenha'];
$confirmSenha = $_POST['confSenha'];

if(password_verify($senhaAtual, $dados['senha'])){
    if($novaSenha == $confirmSenha){
        $hash = password_hash($novaSenha, PASSWORD_ARGON2I);
        $sql_update = "UPDATE usuario SET senha='$hash' 
        WHERE id_usuario=" . $_SESSION['user'][0];
        executarSQL($conexao,$sql_update);
        header('location: vizuperfil.php');
    } else {
        echo "Senhas diferentes! Tente novamente
        <a href='formalterarsenha.php'>Voltar</a>";
    }
    die();
} else {
    echo "A senha atual esta incorreta! Tente mudar sua senha novamente
    <a href='formalterarsenha.php'>Voltar</a>";
}




?>