<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

include_once "../conexao.php";
$conexao = conectar();

$sql_eve = "SELECT * FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
$result_eve = executarSQL($conexao, $sql_eve);

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

<body>


    <main class="container" style="margin-top: 50px;">

        <div class="side">
            <a href="vizuPerfil.php">Meus dados</a>
            <a href="vizuEventosCad.php">Eventos cadastrados</a>
            <a href="vizuIngressosCad.php">Ingressos cadastrados</a>
            <a href="pedidos.php">Pedidos</a>
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
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero residencial</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($dados2 = mysqli_fetch_assoc($result_eve)) : $arq = $dados2['imagem']; ?>

                    <tr>
                        <td><?= $dados2['id_evento'] ?></td>
                        <td><img src="../imagens/<?= $arq ?>" height="55"></td>
                        <td><?= $dados2['nome_evento'] ?></td>
                        <td><?= $dados2['produtora'] ?></td>
                        <td><?= $dados2['descricao'] ?></td>
                        <td><?= $dados2['data'] ?></td>
                        <td><?= $dados2['cep'] ?></td>
                        <td><?= $dados2['rua'] ?></td>
                        <td><?= $dados2['bairro'] ?></td>
                        <td><?= $dados2['numero_residencial'] ?></td>
                        <td><a href="../crudEvento/formediteven?id_evento=<?= $dados2['id_evento']; ?>"><i class="material-icons" style="color: green;">create</i></a></td>
                        <td><a href="#modalExcluirEvento<?= $dados2['id_evento']; ?>" class="modal-trigger"><i class="material-icons" style="color: #c62828;">delete</i></a></td>
                    </tr>

                    <div id="modalExcluirEvento<?= $dados2['id_evento']; ?>" class="modal">
                        <div class="modal-content">
                            <h4>Confirmar exclusão</h4>
                            <p>Você tem certeza que deseja excluir esse evento? Qualquer pessoa que possuir esse ingresso, irá perder ele.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                            <a href="../crudevento/excluireven?id_evento=<?= $dados2['id_evento']; ?>" class="modal-close waves-effect waves-green btn-flat">Confirmar</a>
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
        $('.materialboxed').materialbox(); // Inicializando o materialbox
        $('.sidenav').sidenav(); // Iniciando o sidenav
    });

    $(document).ready(function() {
        $('.modal').modal(); // Inicializando os modais
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, options);
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