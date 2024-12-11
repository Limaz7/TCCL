<?php

include("../conexao.php");
$conexao = conectar();

session_start();

$sql = "SELECT * FROM ingressos_cadastrados ic INNER JOIN eventos e
        ON e.id_evento = ic.id_evento WHERE e.id_usuario=" . $_SESSION['user'][0];
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

    <?php include("../Navs/sidenav.php") ?>

</head>

<style>
    .sidenav {
        background-color: #f9f9f9;
        /* Cor de fundo clara */
        width: 250px;
        /* Largura fixa */
        height: auto;
        /* Altura ajustada para ficar menor */
        margin-top: 30vh;
        /* Centralizando verticalmente na tela */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        /* Sombra leve */
        border-radius: 8px;
        /* Cantos arredondados */
        padding-bottom: 10px;
        /* Espaço inferior */
    }

    .sidenav a {
        color: #333;
        /* Cor do texto */
        font-weight: bold;
        /* Negrito */
        display: block;
        /* Ocupando a largura total */
        text-align: center;
        /* Centralizar os links */
    }

    .sidenav li {
        border-bottom: 1px solid #ddd;
        /* Separação das opções */
        padding: 10px 15px;
    }

    .sidenav a:hover {
        background-color: #eee;
        /* Cor de fundo ao passar o mouse */
    }

    .sidenav-fixed {
        position: fixed;
        top: 64px;
        /* Ajuste conforme o header, se houver */
        left: 0;
        height: calc(100% - 64px);
        /* Ajuste dinâmico para ocupar a tela */
        overflow-y: auto;
    }

    .content {
        margin-left: 260px;
        /* Espaço para o conteúdo principal ao lado da sidenav */
        padding: 20px;
    }
</style>

<?php include('../Navs/headers.php') ?>


<body>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="vizuperfil.php">Meus dados</a></li>
        <li><a href="vizueventoscad.php">Eventos Cadastrados</a></li>
        <li><a href="vizuIngressoCadastrados.php">Ingressos cadastrados</a></li>
    </ul>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">
        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Descricão do ingresso</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ?></td>
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['informacao'] ?></td>
                        <td><?= $results['valor'] ?></td>
                        <td><?= $results['quantidade'] ?></td>
                        <td><a href="../crudIngresso/formEditIngresso?id_ingresso=<?= $results['id_ingresso']; ?>">Editar</a></td>
                        <td><a href="../crudIngresso/excluirIngresso?id_ingresso=<?= $results['id_ingresso']; ?>">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>

</html>