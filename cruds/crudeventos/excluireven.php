<?php

$id = $_GET["id"];

include "../conexao.php";

$sql = "DELETE FROM eventos WHERE id_eventos = $id";

mysqli_query($conecta, $sql);   

if($conecta->error){
    die("Erro".$conecta->error);
} else {
    header("location: listareventos.php");
}