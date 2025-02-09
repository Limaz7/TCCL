<?php

include("../conexao.php");
$conexao = conectar();

session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../telalogin.php');
}

$ingressos = "SELECT * FROM ingressos_cadastrados ic INNER JOIN eventos e
        ON e.id_evento = ic.id_evento WHERE e.id_usuario=" . $_SESSION['user'][0];
$exec = executarSQL($conexao, $ingressos);

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

    .container .striped tbody tr td i {
        color: black;
    }
</style>

<?php include('../Navs/headers.php') ?>


<body>


    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuPerfil.php">Meus dados</a>
            <a href="vizuEventosCad.php">Eventos cadastrados</a>
            <a href="vizuIngressosCad.php">Ingressos cadastrados</a>
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
                <?php if (mysqli_num_rows($exec)): ?>
                    <?php while ($results = mysqli_fetch_assoc($exec)) : ?>
                        <tr>
                            <td><?= $results['id_ingresso'] ?></td>
                            <td><?= $results['nome_evento'] ?></td>
                            <td><?= $results['desc_ingresso'] ?></td>
                            <td><?= $results['valor'] ?></td>
                            <td><?= $results['estoque'] ?></td>

                            <td><a href="#modalEditarIngresso<?= $results['id_ingresso']; ?>" class="modal-trigger"><i class="material-icons" style="color: green;">create</i></a></td>

                            <td><a class="waves-effect waves-light modal-trigger" href="#modalConfirma<?= $results['id_ingresso']; ?>"><i class="material-icons" style="color: #c62828;">delete</i></a></td>
                        </tr>

                        <div id="modalEditarIngresso<?= $results['id_ingresso']; ?>" class="modal">
                            <div class="modal-content">
                                <h4>Editar ingresso:</h4>
                                <form action="../crudIngresso/editingresso.php" method="post">

                                    <input type="hidden" value="<?= $results['id_ingresso']; ?>" name="id" />

                                    <div class="input-field col s12">
                                        <p>Nome do ingresso: <input type="text" value="<?= $results['nome_ingresso']; ?>" name="nome" /></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Descrição: <input type="text" name="info" value="<?= $results['desc_ingresso']; ?>"></textarea></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>valor: <input type="text" name="valor" value="<?= $results['valor']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Quantidade: <input type="number" name="quant" value="<?= $results['estoque']; ?>"></p>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                        <button class="waves-effect waves-green btn-flat">Editar</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                        <!-- Modal -->
                        <div id="modalConfirma<?= $results['id_ingresso']; ?>" class="modal">
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
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum ingresso cadastrado.</td>
                    </tr>
                <?php endif; ?>
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