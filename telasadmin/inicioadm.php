<?php

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
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
    <title>Document</title>
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

    <?php include("sidenav.php"); ?>



    <main class="container" style="margin-top: 100px; margin-left: 400px;">
        <p><a href="../logout.php">Sair</a></p>

        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Validação de entrada</th>
                    <th>Tipo de usuário</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($result as $results) { ?>
                        <?php if ($results['id_usuario'] > 1) { ?>
                            <td><?= $results['id_usuario'] ?></td>
                            <td><?= $results['nome'] ?></td>
                            <td><?= $results['email'] ?></td>
                            <td><?= $results['cod_ativacao'] ?></td>
                            <td><?= $results['tipo_usuario'] ?> </td>
                            <td><a href="formedituser?id_usuario=<?= $results['id_usuario']; ?>">Editar</a></td>
                            <td><a href="excluiruser?id_usuario=<?= $results['id_usuario']; ?>">Excluir</a></td>
                        <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr>
        <p>Tipo de usuário:</p>
        <p>2 - Participante</p>
        <p>3 - Empresa</p>

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
</script>

</html>