<?php

session_start();

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT  ic.id_ingresso, 
                ic.token,
                ic.id_usuario,
                ic.quantidade,
                ic.data,
                ic.pago,
                u.nome,
                e.nome_evento
        FROM 
            ingressos_comprados ic 
        INNER JOIN
            usuarios u ON u.id_usuario = ic.id_usuario
        INNER JOIN 
            ingressos_cadastrados ia ON ia.id_ingresso = ic.id_ingresso
        INNER JOIN 
            eventos e ON ia.id_evento = e.id_evento
        WHERE 
            ic.id_usuario =" . $_SESSION['user'][0];

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

<?php include('../Navs/headers.php'); ?>

<body>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="vizuperfil.php">Meus dados</a></li>
        <li><a href="vizuingressocomp.php">Histórico de compras</a></li>
    </ul>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">
        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Token</th>
                    <th>Usuário</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Confirmação de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ;?></td>
                        <td><?= $results['nome_evento']; ?></td>
                        <td><?= $results['token']; ?></td>
                        <td><?= $results['nome']; ?></td>
                        <td><?= $results['quantidade']; ?></td>
                        <td><?= $results['data']; ?></td>
                        <?php if ($results['pago'] == 0) : ?>
                            <td>Aguardando pagamento</td>
                        <?php else: ?>
                            <td>Pago</td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

</body>

</html>