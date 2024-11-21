<?php


include('../conexao.php');
$conexao = conectar();

$id = $_GET['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id_usuario= '$id'";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
</head>

<body>
    <h1>Editar usuario </h1>
    <form action="editusers.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>"> <br><br>
        Email: <input type="text" name="email" value="<?= $dados['email'] ?>"> <br></br>
        <hr>
        Codigo para acesso no sistema:
        <p>1 - Acesso liberado</p>
        <p>2 - Em analise</p>
        <p>3 - Acesso negado</p>
        <hr>
        Codigo de ativação: <input type="number" name="cod_atv" value="<?= $dados['cod_ativacao'] ?>"> <br><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>