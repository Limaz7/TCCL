<?php

include_once "../conexao.php";
$conexao = conectar();

session_start();
session_regenerate_id(true);

$antfoto = $_POST['img_perfil'];

$nome = $_POST['nome'];
$email = $_POST['email'];

$img = $_FILES['img_perfil'];


$sql = "UPDATE usuarios SET nome='$nome', email='$email'
        WHERE id_usuario=" . $_SESSION['user'][0];
executarSQL($conexao, $sql);

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
}

header('location: vizuperfil.php');
