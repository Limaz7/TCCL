<?php

$nome = $_POST["nome"];
$desc = $_POST["desc"];
$data = $_POST["data"];

include "../conexao.php";

$sql = "INSERT INTO eventos(nome, descricao, data) VALUES ('$nome', '$desc', '$data')";

mysqli_query($conecta, $sql);

if($conecta->errno){
    die("erro".$conecta->error);
} else {
    header("location: listareventos.php");
}

