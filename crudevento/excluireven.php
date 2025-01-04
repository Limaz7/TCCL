<?php

$id = $_GET['id_evento'];

include "../conexao.php";
$conexao = conectar();

$pastaImg = "../imagens/";

$sql1 = "SELECT e.imagem FROM eventos e WHERE id_evento = '$id'";
$result = executarSQL($conexao, $sql1);
$img = mysqli_fetch_assoc($result);

unlink($pastaImg . $img['imagem']);

$sql_ingresso = "DELETE FROM ingressos_cadastrados WHERE id_evento = '$id'";
executarSQL($conexao, $sql_ingresso);

$sql_even = "DELETE FROM eventos WHERE id_evento = '$id'";
executarSQL($conexao, $sql_even);

session_start();

$_SESSION['mensagem'][0] = 'Evento excluido com sucesso!';
$_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

header('location: ../Perfil/vizuEventosCad.php');
die();

if ($conexao->error) {
    die("Erro" . $conexao->error);
}
