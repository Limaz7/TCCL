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

<body>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="vizuPerfil.php">Meus dados</a></li>
        <li><a href="vizuEventosCad.php">Eventos cadastrados</a></li>
        <li><a href="vizuIngressosCad.php">Ingressos cadastrados</a></li>
    </ul>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">

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
                        <td><a href="../crudEvento/formediteven?id_evento=<?= $dados2['id_evento']; ?>">Editar</a></td>
                        <td><a href="../crudEvento/excluireven?id_evento=<?= $dados2['id_evento']; ?>">Excluir</a></td>
                    </tr>

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