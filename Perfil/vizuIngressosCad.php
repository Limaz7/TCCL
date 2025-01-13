<?php

include("../conexao.php");
$conexao = conectar();

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

$ingressos = "SELECT * FROM ingressos_cadastrados ic INNER JOIN eventos e
        ON e.id_evento = ic.id_evento WHERE e.id_usuario=" . $_SESSION['user'][0];
$result_ingressos = executarSQL($conexao, $ingressos);

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
        border-radius: 8px;
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

<?php include('../Navs/headers.php') ?>


<body>


    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuPerfil.php">Meus dados</a>
            <a href="vizuEventosCad.php">Eventos cadastrados</a>
            <a href="vizuIngressosCad.php">Ingressos cadastrados</a>
            <a href="pedidos.php">Pedidos</a>
        </div>

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
                <?php while ($results = mysqli_fetch_assoc($result_ingressos)) : ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ?></td>
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['desc_ingresso'] ?></td>
                        <td><?= $results['valor'] ?></td>
                        <td><?= $results['estoque'] ?></td>
                        <td><a href="../crudIngresso/formEditIngresso?id_ingresso=<?= $results['id_ingresso']; ?>"><i class="material-icons">create</i></a></td>
                        <td><a href=""><i class="material-icons">toc</i></a></td>
                        <td><a class="waves-effect waves-light modal-trigger" href="#modalConfirma"><i class="material-icons">delete</i></a></td>
                    </tr>



                    <!-- Modal -->
                    <div id="modalConfirma" class="modal">
                        <div class="modal-content">
                            <h4>Confirmar exclusão</h4>
                            <p>Você tem certeza que deseja excluir esse ingresso? Qualquer pessoa que possuir esse ingresso, irá perder ele.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                            <a href="../crudIngresso/excluirIngresso?id_ingresso=<?= $results['id_ingresso']; ?>" class="modal-close waves-effect waves-green btn-flat">Confirmar</a>
                        </div>
                    </div>



                <?php endwhile; ?>
            </tbody>
        </table>

    </main>

</body>

<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.modal').modal(); // Inicializando os modais
    });
</script>

<?php

include("../functionMensagens.php");

if (isset($_SESSION['mensagem'])):
    exibirMensagem($_SESSION['mensagem'][0], $_SESSION['mensagem'][1]);
    unset($_SESSION['mensagem']);
endif;

?>

</html>