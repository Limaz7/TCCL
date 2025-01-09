<?php

include_once "../conexao.php";
$conexao = conectar();

session_start();

$antfoto = $_POST['img_perfil'];

$nome = $_POST['nome'];
$email = $_POST['email'];

$img = $_FILES['img_perfil'];


$update_user = "UPDATE usuarios SET nome='$nome', email='$email'
        WHERE id_usuario=" . $_SESSION['user'][0];
$exec_update = executarSQL($conexao, $update_user);


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

if($exec_update){
        $_SESSION['mensagem'][0] = "Perfil atualizado com sucesso!";
        $_SESSION['mensagem'][1] = "light-green darken-3";
        header('location: vizuperfil.php');
        die();
} else {
        $_SESSION['mensagem'][0] = "Não foi possivel atualizar o perfil!";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
        header('location: vizuperfil.php');
        die();
}
