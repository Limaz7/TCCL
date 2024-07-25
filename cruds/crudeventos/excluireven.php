<?php

$id = $_GET["id"];

include "../conexao.php";
$conecta = conectar();

$sql = "DELETE FROM eventos WHERE id_eventos = $id";

executarSQL($conecta, $sql);   

if($conecta->error){
    die("Erro".$conecta->error);
} else {
    header("location: listareventos.php");
}