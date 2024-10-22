<?php

session_start();
session_regenerate_id(true);

include "../conexao.php";
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

$extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

if ($foto['size'] > 10000000) {
    echo "O arquivo é maior que 10Mb. 
    Escolha outra foto";
    die();
}

if ($foto['error'] != 0) {
    echo "Erro ao receber a imagem do evento! Tente novamente: <a href='formcadeventos.php'>Voltar</a>";
    die();
}
if (
    $extensao != "jpg" && $extensao != "png"
    && $extensao != "gif" && $extensao != "jfif"
    && $extensao != "svg" && $extensao != "jpeg"
) {
    echo "Isso nao é uma imagem! <a href='formcadeventos.php'>Voltar</a>";
    die();
}

if ($foto['error'] == 0) {
    $pastaDestino = "../imagens/";
    $novo_nome_ft = uniqid() . "." . $extensao;
    $move_foto = move_uploaded_file($foto['tmp_name'], $pastaDestino . $novo_nome_ft);
}

if ($conecta->errno) {
    die("erro" . $conecta->error);
} else {
    header("location: ../inicial.php");
}

$sql_even = "INSERT INTO eventos (id_usuario, nome_evento, nome_empresa, descricao, data, cep, rua, bairro, numero, imagem) 
                VALUES ('". $_SESSION['user'][0] . "', '$nomeEven', '$nomeEmp', '$desc', '$data', '$cep', '$rua', '$bairro', '$numImo', '$novo_nome_ft')";
executarSQL($conecta, $sql_even);

header('location: ../inicial.php');