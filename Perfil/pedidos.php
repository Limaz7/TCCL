<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../telalogin.php');
}

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT
                c.ticket,
                c.id_usuario,
                c.quantidade,
                c.data,
                c.pago,
                u.nome,
                e.nome_evento,
                cic.id_ingresso
        FROM 
            carrinhos c
        INNER JOIN
            usuarios u ON u.id_usuario = c.id_usuario
        INNER JOIN
            carrinho_ingressos_cadastrados cic ON cic.id_carrinho = c.id_carrinho
        INNER JOIN 
            ingressos_cadastrados ia ON ia.id_ingresso = cic.id_ingresso
        INNER JOIN 
            eventos e ON ia.id_evento = e.id_evento
        WHERE 
            e.id_usuario =" . $_SESSION['user'][0];

$exec = executarSQL($conexao, $sql);

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
    .container {
        display: flex;
        /* Usa flexbox para alinhar os itens lado a lado */
        align-items: flex-start;
    }

    .side {
        background-color: rgb(240, 240, 240);
        width: 200px;
        /* Ajuste a largura conforme necessário */
        padding: 10px;
        /* Substitui a margin-top para espaçamento interno */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        height: auto;
        /* Permite ajustar à altura do conteúdo */
        position: relative;
        /* Use fixed para uma posição persistente se necessário */
        top: 0;
        /* Remove margens desnecessárias */
        margin-right: 20px;
        /* Espaço entre o side e o card */
        margin-top: 15.7%;
        max-height: 190px;
    }

    .side a {
        display: block;
        /* Links na sidebar ficam um abaixo do outro */
        padding: 10px 0;
        color: #333;
        text-decoration: none;
        padding-left: 15px;
    }

    .side a:hover {
        background-color: #ddd;
    }

    .striped {
        flex-grow: 1;
        /* Expande o card-panel para ocupar o espaço restante */
        margin-top: 10%;
        width: 10%;
    }
</style>

<?php include('../Navs/headers.php'); ?>

<body>

    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuPerfil.php">Meus dados</a>
            <a href="vizuEventosCad.php">Eventos cadastrados</a>
            <a href="vizuIngressosCad.php">Ingressos cadastrados</a></li>
            <a href="pedidos.php">Pedidos</a>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Participante</th>
                    <th>Evento</th>
                    <th>Ticket</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Confirmação de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($exec)): ?>
                    <?php while ($results = mysqli_fetch_assoc($exec)) : ?>
                            <tr>
                                <td><?= $results['id_ingresso']; ?></td>
                                <td><?= $results['nome']; ?></td>
                                <td><?= $results['nome_evento']; ?></td>
                                <td><?= $results['ticket']; ?></td>
                                <td><?= $results['quantidade']; ?></td>
                                <td><?= $results['data']; ?></td>
                                <?php if ($results['pago'] == 0) : ?>
                                    <td>Aguardando pagamento</td>
                                <?php else: ?>
                                    <td>Pago</td>
                                <?php endif; ?>
                            </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Nenhum ingresso comprado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

</body>

</html>