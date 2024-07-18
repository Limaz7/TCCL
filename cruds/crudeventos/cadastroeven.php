<?php

$nome = $_POST["nome"];
$desc = $_POST["desc"];
$data = $_POST["data"];
$arq = $_POST['arquivo'];

include "../conexao.php";

$sql = "INSERT INTO eventos(nome, descricao, data, imagem) VALUES ('$nome', '$desc', '$data', '$arq')";

mysqli_query($conecta, $sql);

if($conecta->errno){
    die("erro".$conecta->error);
} else {
    header("location: listareventos.php");
}

