<?php

$id = $_POST["id"];
$nomeEven = $_POST["nomeEven"];
$desc = $_POST["desc"];
$img = $_POST["img"];
$data = $_POST["data"];


include "./conexao.php";
$conecta = conectar();

$sql = "UPDATE eventos SET nome = '$nome', descricao = '$desc', imagem = '$img', data = '$data' WHERE id_eventos = $id";

executarSQL($conecta, $sql);

if($conecta->error){
    die("erro".$conecta->error);
} else {
    header("location: listareventos.php");
}

?>