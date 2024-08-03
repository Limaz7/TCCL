<?php
session_start();
session_regenerate_id(true);

include "conexao.php";
$conexao = conectar();

if (!isset($_SESSION['user'][0])) {
    header("location:../index.php");
    die();
}

$antfoto = $_POST['antfoto'];
$id = $_POST["id"];
$nomeEven = $_POST["nome"];
$desc = $_POST["desc"];
$img = $_FILES["img"];
$data = $_POST["data"];

$destino = "imagens/";

if ($_FILES['img']['name'] == null) {
    $sql = "UPDATE eventos SET nome_evento = '$nomeEven', descricao = '$desc', 
            data = '$data' WHERE id_eventos = '$id'";

    executarSQL($conexao, $sql);

    header('location: ../iniempresa.php');
    die();
} else {

    if ($img['error'] != 0) {
        echo "Falha ao receber a foto do evento! <p><a href = \"formediteven.php\">Tente novamente</a></p>";
        die();
    } else {


        $nome_img = $img['name'];

        $novo_nome_img = uniqid();

        $extensao = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
    }
    if (
        $extensao != "png" and $extensao != "jpeg" and
        $extensao != "gif" and $extensao != "jfif" and
        $extensao != "svg"  and $extensao != "jpg"
    ) {
        echo "Isso não é uma imagem! Tente novamente: <p><a href = \"formediteven.php\">Voltar</a></p>";
    } else {

        $trocar_img = move_uploaded_file($img['tmp_name'], $destino . $novo_nome_img . "." . $extensao);

        if ($trocar_img) {

            $caminho = $novo_nome_img . "." . $extensao;

            $sql = "UPDATE eventos SET imagem = '$caminho' WHERE id_eventos = '$id'";

            executarSQL($conexao, $sql);

            unlink($destino . $antfoto);

            header("location: ../iniempresa.php");
        }
    }
}

if ($conecta->error) {
    die("erro" . $conecta->error);
} else {
    header("location: ../iniempresa.php");
}
