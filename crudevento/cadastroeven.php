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
$qtd = $_POST['qtd'];
$preco = $_POST['preco'];

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

$sql_even = "INSERT INTO eventos(nome_evento, nome_empresa, descricao, data, imagem) 
                VALUES ('$nomeEven', '$nomeEmp', '$desc', '$data', '$novo_nome_ft')";
executarSQL($conecta, $sql_even);
$id_evento = mysqli_insert_id($conecta);

$sql_endere = "INSERT INTO enderecos (id_evento, cep, rua, numero, bairro) 
                VALUES ('$id_evento', '$cep', '$rua', '$numImo', '$bairro')";
executarSQL($conecta, $sql_endere);

$sql_ingresso = "INSERT INTO ingressos (valor, id_evento, quantidade)
                    VALUES ('$preco', '$id_evento', '$qtd')";
executarSQL($conecta, $sql_ingresso);
