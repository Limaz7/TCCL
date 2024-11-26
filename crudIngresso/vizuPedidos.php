<?php

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM ingressos_comprados ic INNER JOIN
        usuarios u ON u.id_usuario = ic.id_usuario";
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
    <title></title>
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

<?php include('../Navs/sidenav.php'); ?>

<body>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">
        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Token</th>
                    <th>Usuário</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Confirmação de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $results) { ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ?></td>
                        <td><?= $results['token'] ?></td>
                        <td><?= $results['nome'] ?></td>
                        <td><?= $results['quantidade'] ?></td>
                        <td><?= $results['data'] ?></td>
                        <?php if($results['pago'] == 0) : ?>
                            <td>Aguardando pagamento</td>
                        <?php else: ?>
                            <td>Pago</td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>

</html>