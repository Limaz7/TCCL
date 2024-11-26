<?php

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_ingresso'];

$sql = "SELECT * FROM ingressos_cadastrados WHERE id_ingresso='$id'";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="editIngresso.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        Informação <input type="text" name="info" value="<?= $dados['informacao'] ?>"> <br><br>
        Valor <input type="number" name="valor" value="<?= $dados['valor'] ?>"> <br><br>
        Quantidade <input type="number" name="quant" value="<?= $dados['quantidade'] ?>"> <br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>