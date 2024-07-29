<?php

session_start();
session_regenerate_id(true);

include "conexao.php";
$conecta = conectar();

$idEven = $_POST['idEven'];
$_SESSION['even'][0] = $idEven;

$nomeEven = $_POST["nomeEven"];
$nomeEmp = $_POST['nomeEmp'];
$desc = $_POST["desc"];
$data = $_POST["data"];

// Definindo a pasta de destino
$pastaDestino = "imagens/";

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
    $mover_foto = move_uploaded_file($foto['tmp_name'], $pastaDestino . $novo_nome_ft . "." . $extensao);

    if ($mover_foto) {

        //criar o caminho.
        $caminho = $novo_nome_ft . "." . $extensao;
    }
}

if ($conecta->errno) {
    die("erro" . $conecta->error);
} else {
    header("location: ../iniempresa.php");
}



$sql = "INSERT INTO eventos(nome_evento, nome_empresa, descricao, data, imagem) VALUES ('$nomeEven', '$nomeEmp', '$desc', '$data', '$caminho')";

executarSQL($conecta, $sql);
