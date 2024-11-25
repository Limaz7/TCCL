<?php

include("../conexao.php");
$conexao = conectar();

$sql = "SELECT * FROM ingressos_cadastrados";
$result = executarSQL($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vizuingressos</title>

    <?php include("sidenav.php") ?>

</head>

<style>
    /* Estilo para o item ativo da sidenav */
    .sidenav .active {
        background-color: white !important;
        /* Cor de fundo para o item ativo (rosa) */
        color: black !important;
        /* Cor do texto do item ativo */
    }

    /* Estilo adicional para links quando ativos */
    .sidenav li.active a {
        color: black !important;
        /* Garantir que o texto seja branco */
    }
</style>


<body>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">
        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID evento</th>
                    <th>Descricão do ingresso</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $results) { ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ?></td>
                        <td><?= $results['id_evento'] ?></td>
                        <td><?= $results['informacao'] ?></td>
                        <td><?= $results['valor'] ?></td>
                        <td><?= $results['quantidade'] ?></td>
                        <td><a href="editarIngresso.php?id_ingresso=<?= $results['id_ingresso']; ?>">Editar</a></td>
                        <td><a href="excluirIngresso;php?id_ingresso=<?= $results['id_ingresso']; ?>">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>

</html>