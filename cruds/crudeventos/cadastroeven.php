<?php
include "../conexao.php";
$conecta = conectar();

$nome = $_POST["nome"];
$desc = $_POST["desc"];
$data = $_POST["data"];
// Definindo a pasta de destino
$pastaDestino = "../imagens/";

// Pegar o nome do arquivo
$foto = $_FILES['arquivo'];
// Nome da foto
$nome_foto = $foto['name'];

$novo_nome_ft = uniqid();

$extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));


if ($_FILES['arquivo']['size'] > 10000000) {
    echo "O arquivo é maior que 10Mb. 
        Escolha outra foto";

    die();
}

if (
    $extensao != "jpg" && $extensao != "png"
    && $extensao != "gif" && $extensao != "jfif"
    && $extensao != "svg"
) {
    echo "Isso nao é uma imagem";
    exit;
} else {
    //mover o arquivo.
    $mover_foto = move_uploaded_file($foto['tmp_name'], $pastaDestino . $novo_nome_ft . "." . $extensao);

    //verificar se deu certo mover certificado.
    if ($mover_foto) {

        //criar o caminho.
        $caminho = $novo_nome_ft . "." . $extensao;

        if (isset($_POST['imagem'])) {

            unlink($pastaDestino . $_POST['imagem']);

            header("location: trocarImg.php");
        } else {

            header("location: trocarImg.php");
        }
    }
}

if ($conecta->errno) {
    die("erro" . $conecta->error);
} else {
    header("location: listareventos.php");
}



$sql = "INSERT INTO eventos(nome, descricao, data, imagem) VALUES ('$nome', '$desc', '$data', '$caminho')";

executarSQL($conecta, $sql);
