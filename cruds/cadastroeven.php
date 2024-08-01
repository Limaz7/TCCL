<?php

session_start();
session_regenerate_id(true);

include "conexao.php";
$conecta = conectar();

$nomeEven = $_POST["nomeEven"];
$nomeEmp = $_POST['nomeEmp'];
$desc = $_POST["desc"];
$data = $_POST["data"];
$foto = $_FILES['arquivo'];
$cep = $_POST['cep'];
$rua = $_POST["rua"];
$numImo = $_POST["numImo"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];

$extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

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
    die();
} else {

    if ($foto['error'] == 0) {
        $pastaDestino = "imagens/";
        $novo_nome_ft = uniqid() . "." . $extensao;
        $move_foto = move_uploaded_file($foto['tmp_name'], $pastaDestino . $novo_nome_ft);
    }

    if ($conecta->errno) {
        die("erro" . $conecta->error);
    } else {
        header("location: ../iniempresa.php");
    }
}

$sql_even = "INSERT INTO eventos(nome_evento, nome_empresa, descricao, data, imagem) 
                VALUES ('$nomeEven', '$nomeEmp', '$desc', '$data', '$novo_nome_ft')";
executarSQL($conecta, $sql_even);
$id_evento = mysqli_insert_id($conecta);

$sql_endere = "INSERT INTO endereco (id_eventos, cep, rua, numero, bairro, cidade, estado) 
                VALUES ('$id_evento', '$cep', '$rua', '$numImo', '$bairro', '$cidade', '$estado')";
executarSQL($conecta, $sql_endere);
