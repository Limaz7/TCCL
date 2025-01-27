<?php

include_once "../conexao.php";
$conexao = conectar();

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];

$updateUser = "UPDATE usuarios SET nome='$nome', email='$email'
        WHERE id_usuario=" . $_SESSION['user'][0];
$execUpdate = executarSQL($conexao, $updateUser);


//Trocar a foto de perfil
/*
if (
        $extensao != "jpg" && $extensao != "png"
        && $extensao != "gif" && $extensao != "jfif"
        && $extensao != "svg" && $extensao != "jpeg"
) {
        echo "Isso nao é uma imagem! <a href='formediteven.php'>Voltar</a>";
        die();
}


if ($img['error'] == 0) {
        $pastaDestino = "../imagens/";
        $novo_nome_ft = uniqid() . "." . $extensao;
        $trocar_img = move_uploaded_file($img['tmp_name'],  $pastaDestino . $novo_nome_ft);

        if ($trocar_img) {
                $sql = "UPDATE usuarios SET imagem = '$novo_nome_ft' WHERE id_evento='$id'";
                executarSQL($conexao, $sql);
                unlink($pastaDestino . $antfoto);
                header("location: ../inicial.php");
        }
} */

if ($execUpdate) {

        $selectUser = "SELECT nome, email FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
        $execSelectUser = executarSQL($conexao, $selectUser);
        $updatedUser = mysqli_fetch_assoc($execSelectUser);

        $_SESSION['user'][1] = $updatedUser['nome'];

        $_SESSION['mensagem'][0] = "Perfil editado com sucesso!";
        $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";

        header('location: vizuperfil.php');
        die();
} else {
        $_SESSION['mensagem'][0] = "Não foi possível editar o perfil. Por favor, tente novamente.";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
        header('location: vizuperfil.php');
        die();
}
