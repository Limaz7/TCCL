<?php

session_start();

if ($_SESSION['user'][2] == 3 || $_SESSION['user'][2] == 2 || !isset($_SESSION['user'])) {
    session_destroy();
    header('location: ../telalogin.php');
    die();
}

include("../conexao.php");
$conexao = conectar();

$sql = "SELECT * FROM ingressos_cadastrados ic INNER JOIN eventos e
        ON e.id_evento = ic.id_evento";
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
                    <th>Evento</th>
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
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['desc_ingresso'] ?></td>
                        <td><?= $results['valor'] ?></td>
                        <td><?= $results['estoque'] ?></td>
                        <td><a href="formEditIngresso?id_ingresso=<?= $results['id_ingresso']; ?>">Editar</a></td>
                        <td><a href="../crudIngresso/excluirIngresso?id_ingresso=<?= $results['id_ingresso']; ?>">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>

<!-- Import jQuery antes do materialize.min.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Agora, importe o materialize.min.js -->
<script type="text/javascript" src="../js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });

    <?php if (isset($_SESSION['mensagem'])): ?>
        M.toast({
            html: '<?= $_SESSION['mensagem'][0] ?>',
            classes: '<?= $_SESSION['mensagem'][1] ?>'
        });

    <?php unset($_SESSION['mensagem']);
    endif; ?>
</script>

</html>