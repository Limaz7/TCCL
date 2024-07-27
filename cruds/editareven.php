<?php


session_start();
session_regenerate_id(true);

include "conexao.php";
$conexao = conectar();

if (!isset($_SESSION['user'][0])) {
    header("location:../index.php");
    die();
}

$id = $_POST["id"];
$nomeEven = $_POST["nome"];
$desc = $_POST["desc"];
$img = $_FILES["img"];
$data = $_POST["data"];

$destino = "imagens/";

if ($img['error'] != 0) {
    echo "Falha ao receber a foto de perfil! <p><a href = \"cruds/crudevetos/formedit.php\">Tente novamente</a></p>";
    die();
} else {


    $nome_img = $img['name'];

    $novo_nome_img = uniqid();

    $extensao = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));


} if (  $extensao != "png" and $extensao != "jpeg" and 
        $extensao != "gif" and $extensao != "jfif" and
        $extensao != "svg"  and $extensao != "jpg"
) {
    echo "Isso não é uma imagem! Tente novamente: <p><a href = \"cruds/crudeventos/formedit.php\">Voltar</a></p>";
} else {

    $trocar_img = move_uploaded_file($img['tmp_name'], $destino . $novo_nome_img . "." . $extensao);

    if ($trocar_img) {

        $caminho = $novo_nome_img . "." . $extensao;

        $sql = "UPDATE eventos SET imagem = '$caminho' WHERE id_eventos = '$id'";
        $sql2 = "SELECT * FROM eventos WHERE id_eventos = '$id'";

        $result = executarSQL($conexao, $sql);
        $result2 = executarSQL($conexao, $sql2);
        $dados = mysqli_fetch_assoc($result2);

        if (isset($_POST['img'])) {

            unlink($destino . $_FILES['img']);

            header("location: ../iniempresa.php");
        } else {

            header("location: ../iniempresa.php");
        }
    }
}


$sql = "UPDATE eventos SET nome_evento = '$nomeEven', descricao = '$desc', 
        imagem = '$caminho', data = '$data' WHERE id_eventos = '$id'";

executarSQL($conecta, $sql);

if ($conecta->error) {
    die("erro" . $conecta->error);
} else {
    header("location: ../iniempresa.php");
}
