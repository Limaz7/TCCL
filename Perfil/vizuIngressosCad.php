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
        <li><a href="vizuPerfil.php">Meus dados</a></li>
        <li><a href="vizuEventosCad.php">Eventos cadastrados</a></li>
        <li><a href="vizuIngressosCad.php">Ingressos cadastrados</a></li>
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
                <?php while ($results = mysqli_fetch_assoc($result_ingressos)) : ?>
                    <tr>
                        <td><?= $results['id_ingresso'] ?></td>
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['desc_ingresso'] ?></td>
                        <td><?= $results['valor'] ?></td>
                        <td><?= $results['estoque'] ?></td>
                        <td><a href="../crudIngresso/formEditIngresso?id_ingresso=<?= $results['id_ingresso']; ?>">Editar</a></td>
                        <td><a class="waves-effect waves-light modal-trigger" href="#modalConfirma">Excluir</a></td>
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