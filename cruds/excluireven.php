<?php

$id = $_GET['id_eventos'];

include "conexao.php";
$conexao = conectar();

$pastaImg = "imagens/";


$sql1 = "SELECT e.imagem FROM eventos e WHERE id_eventos = '$id'";
$result = executarSQL($conexao, $sql1);
$img = mysqli_fetch_assoc($result);


$sql2 = "DELETE FROM eventos WHERE id_eventos = '$id'";
executarSQL($conexao, $sql2);   
unlink($pastaImg . $img['imagem']);

header('location: ../iniempresa.php');


if($conecta->error){
    die("Erro".$conecta->error);
} else {
    header("location: ../iniempresa.php");
}