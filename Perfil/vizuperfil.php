<?php

session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user'])) {
    header('location: index.php');
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

    <?php if ($dados['tipo_usuario'] == 3): ?>
        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li><a href="vizuPerfil.php">Meus dados</a></li>
            <li><a href="vizuEventosCad.php">Eventos Cadastrados</a></li>
            <li><a href="vizuIngressosCad.php">Ingressos cadastrados</a></li>
        </ul>
    <?php endif ?>

    <?php if ($dados['tipo_usuario'] == 2): ?>
        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li><a href="vizuPerfil.php">Meus dados</a></li>
            <li><a href="vizuIngressosBuy.php">Histórico de compras</a></li>
        </ul>
    <?php endif ?>

    <div class="container">
        <div style="margin-top: 10%;" class="card-panel">
            <h1> Meus dados </h1>
            <a href="formalterarsenha.php"> Alterar sua senha </a> <br><br>
            <form action="editPerfil.php" method="post" enctype="multipart/form-data">
                <img src="../imagens/<?= $dados['img_perfil']; ?>" alt="Imagem de perfil" height="100px"> <br><br>
                <label for="nome">
                    Nome: <input type="text" name="nome" id="nome" value="<?= $dados['nome']; ?>">
                </label> <br> <br>
                <label for="email">
                    Email: <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?= $dados['email']; ?>">
                </label> <br>
                <input style="background: #1fce3f; color: white;" class="waves-effect waves-light btn" type="submit" value="Enviar">
                <p><a style="background: #c41707; color: white;" class="waves-effect waves-light btn" href="excluirPerfil.php">Excluir seu perfil</a></p>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/materialize.min.js"></script>

<?php

include('../functionMensagens.php');

if (isset($_SESSION['mensagem'])) {
    exibirMensagem($_SESSION['mensagem'][0], $_SESSION['mensagem'][1]);
    unset($_SESSION['mensagem']);
    die();
}

?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, options);
    });

    // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
    // var collapsibleElem = document.querySelector('.collapsible');
    // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

    // Or with jQuery

    $(document).ready(function() {
        $('.sidenav').sidenav();
    });
</script>

</html>