<?php

session_start();
session_regenerate_id(true);

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao,$sql);
$dados = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Perfil</title>
</head>
<body>
    <h3> Olá <?= $dados['nome']; ?></h3>
    <a href="formeditperf.php">Editar perfil</a> <br><br>
    <a href="../inipessoa.php">Voltar</a>
</body>
</html>