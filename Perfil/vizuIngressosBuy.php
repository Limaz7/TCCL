<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT  ic.id_ingresso, 
                ic.cart_id,
                ic.cart_session,
                ic.ticket,
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
    .container {
        display: flex;
        /* Usa flexbox para alinhar os itens lado a lado */
        flex-wrap: wrap;
        /* Permite que os itens ocupem múltiplas linhas em telas menores */
    }

    .side {
        background-color: rgb(240, 240, 240);
        width: 200px;
        /* Ajuste a largura conforme necessário */
        padding: 10px;
        /* Substitui a margin-top para espaçamento interno */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        height: auto;
        /* Permite ajustar à altura do conteúdo */
        position: relative;
        /* Use fixed para uma posição persistente se necessário */
        top: 0;
        /* Remove margens desnecessárias */
        margin-right: 20px;
        /* Espaço entre o side e o card */
        margin-top: 15.80%;
        max-height: 190px;
    }

    .side a {
        display: block;
        /* Links na sidebar ficam um abaixo do outro */
        padding: 10px 0;
        color: #333;
        text-decoration: none;
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

    .card-panel {
        flex-grow: 1;
        /* Expande o card-panel para ocupar o espaço restante */
    }

    .container .striped tbody i {
        color: black;
    }
</style>

<?php include('../Navs/headers.php'); ?>

<body>


    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuperfil.php">Meus dados</a>
            <a href="vizuIngressosBuy.php">Histórico de compras</a>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Ticket</th>
                    <th>Usuário</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Confirmação de compra</th>
                    <th>Cancelar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $results['id_ingresso']; ?></td>
                        <td><?= $results['nome_evento']; ?></td>
                        <td><?= $results['ticket']; ?></td>
                        <td><?= $results['nome']; ?></td>
                        <td><?= $results['quantidade']; ?></td>
                        <td><?= $results['data']; ?></td>
                        <?php if ($results['pago'] == 0) : ?>
                            <td>Aguardando pagamento</td>
                            <td><a href="../carrinho/ajax/cart/delete?cart_id=<?= $results['cart_id']; ?>&cart_session=<?= $results['cart_session']; ?>"><i class="material-icons">delete</i></a></td>
                        <?php else: ?>
                            <td>Pago</td>
                            <td><i class="material-icons">check</i></td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

</body>

<script src="../js/materialize.min.js"></script>

<script>
    <?php if (isset($_SESSION['mensagem'])): ?>
        M.toast({
            html: '<?= $_SESSION['mensagem'][0] ?>',
            classes: '<?= $_SESSION['mensagem'][1] ?>'
        });

    <?php unset($_SESSION['mensagem']);
    endif; ?>
</script>

</html>