<?php
session_start();
session_regenerate_id(true);

include "../conexao.php";
$conexao = conectar();

if (!isset($_SESSION)) {
    header("location: ../index.php");
    die();
}

$antfoto = $_POST['antfoto'];

$id = $_POST["id"];
$nomeEven = $_POST["nome"];
$desc = $_POST["desc"];
$data = $_POST["data"];
$cep = $_POST["cep"];
$rua = $_POST["rua"];
$numImo = $_POST["numImo"];
$bairro = $_POST["bairro"];
$img = $_FILES["img"];

$extensao = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

if ($_FILES['img']['name'] == null) {

    $sql = "UPDATE eventos
            SET nome_evento = '$nomeEven', descricao = '$desc', 
            data = '$data', cep = '$cep', rua = '$rua', bairro='$bairro', numero_residencial = '$numImo'
            WHERE id_evento = '$id'";
    executarSQL($conexao, $sql);

    $_SESSION['mensagem'][0] = 'Evento editado com sucesso!';
    $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

    header("location: ../Perfil/VizuEventosCad?id_evento=$id");
    die();
}


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
        $sql = "UPDATE eventos SET imagem = '$novo_nome_ft' WHERE id_evento='$id'";
        executarSQL($conexao, $sql);
        unlink($pastaDestino . $antfoto);

        $_SESSION['mensagem'][0] = 'Evento editado com sucesso!';
        $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

        header("location: ../Perfil/vizuEventodCad.php");
        die();
    }
}


if ($conexao->error) {
    die("erro" . $conexao->error);
}