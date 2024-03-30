<?php

$id = $_POST["id"];
$nome = $_POST["nome"];
$desc = $_POST["desc"];
$img = $_POST["img"];
$data = $_POST["data"];


include "conexao.php";

$sql = "UPDATE eventos SET nome = '$nome', descricao = '$desc', imagem = '$img', data = '$data'WHERE id_eventos = $id";

mysqli_query($conecta, $sql);

if($conecta->error){
    die("erro".$conecta->error);
} else {
    header("location: listareventos.php");
}

?>