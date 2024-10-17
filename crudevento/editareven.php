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
$preco = $_POST['preco'];
$qtd = $_POST['qtd'];
$data = $_POST["data"];
$cep = $_POST["cep"];
$rua = $_POST["rua"];
$numImo = $_POST["numImo"];
$bairro = $_POST["bairro"];
$img = $_FILES["img"];

$extensao = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

if ($_FILES['img']['name'] == null) {

    $sql = "UPDATE eventos e JOIN ingressos i ON e.id_evento = i.id_evento
            SET e.nome_evento = '$nomeEven', e.descricao = '$desc', 
            e.data = '$data', e.cep = '$cep', e.rua = '$rua', e.numero = '$numImo',
            i.valor = '$preco', i.quantidade = '$qtd'
            WHERE e.id_evento = '$id'";
    executarSQL($conexao, $sql);
    header('location: ../inicial.php');
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
        header("location: ../iniempresa.php");
    }
}


if ($conexao->error) {
    die("erro" . $conexao->error);
} else {
    header("location: ../iniempresa.php");
}
