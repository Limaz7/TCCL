<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

include_once "../conexao.php";
$conexao = conectar();

$sql_eve = "SELECT * FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
$exec = executarSQL($conexao, $sql_eve);

$sql_user = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result1 = executarSQL($conexao, $sql_user);
$dados_user = mysqli_fetch_assoc($result1);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil</title>
</head>

<?php include("../Navs/headers.php"); ?>

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

    body{
        overflow: hidden;
    }
</style>

<body>


    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuPerfil.php">Meus dados</a>
            <a href="vizuEventosCad.php">Eventos cadastrados</a>
            <a href="vizuIngressosCad.php">Ingressos cadastrados</a>
        </div>

        <table class="striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem do evento</th>
                    <th>Nome do evento</th>
                    <th>Produtora</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero residencial</th>
                    <th colspan="3">Opções</th>
                </tr>
            </thead>

            <tbody>
                <?php if (mysqli_num_rows($exec)): ?>
                    <?php while ($dados2 = mysqli_fetch_assoc($exec)) : $arq = $dados2['imagem']; ?>

                        <tr>
                            <td><?= $dados2['id_evento'] ?></td>
                            <td><img src="../imagens/<?= $arq ?>" height="55"></td>
                            <td><?= $dados2['nome_evento'] ?></td>
                            <td><?= $dados2['produtora'] ?></td>
                            <td><?= strlen($dados2['descricao']) > 100 ? substr($dados2['descricao'], 0, 100) . '...' : $dados2['descricao'] ?></td>
                            <td><?= $dados2['data'] ?></td>
                            <td><?= $dados2['rua'] ?></td>
                            <td><?= $dados2['bairro'] ?></td>
                            <td><?= $dados2['numero_residencial'] ?></td>
                            <td><a href="#modalEditarEvento<?= $dados2['id_evento']; ?>" class="modal-trigger"><i class="material-icons" style="color: green;">create</i></a></td>
                            <td><a href="pedidos?id_evento=<?= $dados2['id_evento']; ?>"><i class="material-icons">local_play</i></a></td>
                            <td><a href="#modalExcluirEvento<?= $dados2['id_evento']; ?>" class="modal-trigger"><i class="material-icons" style="color: #c62828;">delete</i></a></td>
                        </tr>

                        <!-- Modal Structure -->
                        <div id="modalEditarEvento<?= $dados2['id_evento']; ?>" class="modal">
                            <div class="modal-content">
                                <h4>Editar evento:</h4>
                                <form action="../crudEvento/editareven.php" method="post" enctype="multipart/form-data">

                                    <input type="hidden" value="<?= $dados2['imagem']; ?>" name="antfoto" />
                                    <input type="hidden" value="<?= $dados2['id_evento']; ?>" name="id" />

                                    <div class="input-field col s12">
                                        <p>Nome do evento: <input type="text" name="nome" value="<?= $dados2['nome_evento']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Descrição: <textarea id="desc" name="desc" class="materialize-textarea"><?= $dados2['descricao']; ?></textarea></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Rua: <input type="text" name="rua" value="<?= $dados2['rua']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Número do imóvel: <input type="number" name="numImo" value="<?= $dados2['numero_residencial']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Bairro: <input type="text" name="bairro" value="<?= $dados2['bairro']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Data: <input class="btn-datetime" type="datetime-local" name="data" value="<?= $dados2['data']; ?>"></p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Tipo de Pagamento:</p>
                                        <p><select name="tipoPagamento" required>
                                                <option value="" disabled>Escolha seu tipo de pagamento</option>
                                                <option value="1" <?= $dados2['tipo_pagamento'] == 'Gratuito' ? 'selected' : '' ?>>Gratuito</option>
                                                <option value="2" <?= $dados2['tipo_pagamento'] == 'Pago' ? 'selected' : '' ?>>Pago</option>
                                                <option value="3" <?= $dados2['tipo_pagamento'] == 'Cesta básica' ? 'selected' : '' ?>>Cesta básica</option>
                                            </select>
                                        </p>
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Imagem <input type="file" name="img"></p>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                        <button class="waves-effect waves-green btn-flat">Editar</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div id="modalExcluirEvento<?= $dados2['id_evento']; ?>" class="modal">
                            <div class="modal-content">
                                <h4>Confirmar exclusão</h4>
                                <p>Você tem certeza que deseja excluir esse evento?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                <a href="../crudevento/excluireven?id_evento=<?= $dados2['id_evento']; ?>" class="modal-close waves-effect waves-green btn-flat">Confirmar</a>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11">Nenhum evento cadastrado.</td>
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
        $('.materialboxed').materialbox(); // Inicializando o materialbox
        $('.sidenav').sidenav(); // Iniciando o sidenav
    });

    $(document).ready(function() {
        $('.modal').modal(); // Inicializando os modais
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
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