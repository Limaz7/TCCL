<?php

session_start();
session_regenerate_id(true);

include "../conexao.php";
$conexao = conectar();

$sql_select = "SELECT senha FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql_select);
$dados = mysqli_fetch_assoc($result);

$senhaAtual = $_POST['senhaAtual'];
$novaSenha = $_POST['novSenha'];
$confirmSenha = $_POST['confSenha'];

if (password_verify($senhaAtual, $dados['senha'])) {
    if ($novaSenha == $confirmSenha) {
        $hash = password_hash($novaSenha, PASSWORD_ARGON2I);
        $sql_update = "UPDATE usuarios SET senha='$hash' 
        WHERE id_usuario=" . $_SESSION['user'][0];
        $resultUpdate = executarSQL($conexao, $sql_update);
        if ($resultUpdate) {
            $_SESSION['mensagem'] = [
                0 => 'Senha alterada com sucesso!',
                1 => '#558b2f light-green darken-3'
            ];
        } else {
            $_SESSION['mensagem'] = [
                0 => 'Não foi possível alterar sua senha!',
                1 => '#c62828 red darken-3'
            ];
        }

        header('location: vizuperfil.php');
        exit();
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Senhas diferentes! Tente novamente.',
            1 => '#c62828 red darken-3'
        ];
        header('location: formAlterarPass.php');
        die();
    }
    die();
} else {
    $_SESSION['mensagem'] = [
        0 => 'A senha atual está incorreta! Tente novamente alterar sua senha.',
        1 => '#c62828 red darken-3'
    ];
    header('location: formAlterarPass.php');
}
