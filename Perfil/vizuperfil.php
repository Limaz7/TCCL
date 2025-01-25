<?php

session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user'])) {
    header('location: ../telalogin.php');
}

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);
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

<?php
$maxHeight = ($dados['tipo_usuario'] == 2) ? "105px" : "190px";
?>

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
        border-radius: 15px;
        height: auto;
        /* Permite ajustar à altura do conteúdo */
        position: relative;
        /* Use fixed para uma posição persistente se necessário */
        top: 0;
        /* Remove margens desnecessárias */
        margin-right: 20px;
        /* Espaço entre o side e o card */
        margin-top: 20%;
        max-height: <?= $maxHeight ?>;
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

    .card-panel {
        flex-grow: 1;
        /* Expande o card-panel para ocupar o espaço restante */
        border-radius: 15px;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>

<body>


    <div class="container">


        <?php if ($dados['tipo_usuario'] == 3): ?>

            <div class="side">
                <a href="vizuPerfil.php">Meus dados</a>
                <a href="vizuEventosCad.php">Eventos cadastrados</a>
                <a href="vizuIngressosCad.php">Ingressos cadastrados</a>
                <a href="pedidos.php">Pedidos</a>
            </div>
        <?php endif; ?>

        <?php if ($dados['tipo_usuario'] == 2): ?>
            <div class="side">
                <a href="vizuPerfil.php">Meus dados</a>
                <a href="vizuIngressosBuy.php">Histórico de compras</a>
            </div>
        <?php endif; ?>


        <div style="margin-top: 10%;" class="card-panel">
            <h1> Meus dados </h1>
            <a href="formAlterarPass.php"> Alterar sua senha </a> <br><br>
            <form action="editPerfil.php" method="post">
                <label for="nome">
                    Nome: <input type="text" name="nome" id="nome" value="<?= $dados['nome']; ?>">
                </label> <br> <br>
                <label for="email">
                    Email: <input type="text" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?= $dados['email']; ?>">
                </label>
                <div class="buttons">
                    <a style="background: #c41707; color: white;" class="waves-effect waves-light btn btn-exc" href="excluirPerfil.php">Excluir seu perfil</a>
                    <button type="submit" style="background-color: green; color: white;" class="waves-effect waves-light btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/materialize.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });

    // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
    // var collapsibleElem = document.querySelector('.collapsible');
    // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

    // Or with jQuery

    $(document).ready(function() {
        $('.sidenav').sidenav();
    });

    <?php if (isset($_SESSION['mensagem'])): ?>
        M.toast({
            html: '<?= $_SESSION['mensagem'][0] ?>',
            classes: '<?= $_SESSION['mensagem'][1] ?>'
        });

    <?php unset($_SESSION['mensagem']);
    endif; ?>
</script>

</html>