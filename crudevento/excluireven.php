<?php

$id = $_GET['id_eventos'];

include "../conexao.php";
$conexao = conectar();

$pastaImg = "../imagens/";


$sql1 = "SELECT e.imagem FROM eventos e WHERE id_evento = '$id'";
$result = executarSQL($conexao, $sql1);
$img = mysqli_fetch_assoc($result);

$sql_endere = "DELETE FROM enderecos WHERE id_evento = '$id'";
executarSQL($conexao, $sql_endere);   

$sql_even = "DELETE FROM eventos WHERE id_evento = '$id'";
executarSQL($conexao, $sql_even);   
unlink($pastaImg . $img['imagem']);

header('location: ../iniempresa.php');


if($conexao->error){
    die("Erro" . $conexao->error);
} else {
    header("location: ../iniempresa.php");
}