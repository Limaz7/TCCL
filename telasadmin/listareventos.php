<?php

include("../conexao.php");
$conexao = conectar();

$sql = "SELECT * FROM eventos";
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
    <title>listareventos</title>
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

    /* Linha de tabela clara (primeira, terceira, quinta, etc.) */
    table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
        /* Cor de fundo clara */
    }

    /* Linha de tabela escura (segunda, quarta, sexta, etc.) */
    table tbody tr:nth-child(even) {
        background-color: #e0e0e0;
        /* Cor de fundo mais escura */
    }
</style>


<body>

    <?php include("sidenav.php"); ?>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">

        <table style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID produtora</th>
                    <th>Nome do evento</th>
                    <th>Produtora</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero residencial</th>
                    <th>Imagem do evento</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($result as $results) { ?>
                    <tr>
                        <td><?= $results['id_evento'] ?></td>
                        <td><?= $results['id_usuario'] ?></td>
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['produtora'] ?></td>
                        <td><?= $results['descricao'] ?></td>
                        <td><?= $results['data'] ?></td>
                        <td><?= $results['cep'] ?></td>
                        <td><?= $results['rua'] ?></td>
                        <td><?= $results['bairro'] ?></td>
                        <td><?= $results['numero_residencial'] ?></td>
                        <td><?= $results['imagem'] ?></td>
                        <td><a href="">Editar</a></td>
                        <td><a href="">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </main>
</body>

</html>