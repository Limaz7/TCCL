<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

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
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <title></title>
</head>


<style>
    .buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>

<body>

    <main class="container">

        <div class="card-panel">
            <h1>Editar ingresso</h1>
            <form action="../crudIngresso/editIngresso.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                Informação <input type="text" name="info" value="<?= $dados['desc_ingresso'] ?>"> <br><br>
                Valor <input type="text" name="valor" value="<?= $dados['valor'] ?>"> <br><br>
                Quantidade <input type="number" name="quant" value="<?= $dados['estoque'] ?>"> <br><br>

                <div class="buttons">
                    <a href="vizuingressos.php" style="background-color:black; color: white;" class="waves-effect waves-light btn">voltar</a>
                    <input type="submit" style="background-color: green" class="waves-effect waves-light btn" value="Enviar">
                </div>
            </form>
        </div>

    </main>

</body>

</html>