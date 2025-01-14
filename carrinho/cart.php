<?php
ob_start();
session_start();
require '../conexao.php';
$conexao = conectar();
?>

<html lang="pt-br">

<head>
    <meta charset="utf8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="result"></div>
    <article class="container_top">
        <p class="container_top_paragraph"><a href="../inicial.php"><span class="fa fa-caret-square-left"></span> VOLTAR À LOJA</a></p>
    </article>

    <form action="compraringresso.php" method="POST">
        <div id="cart">
            <?php require 'cartLoader.php' ?>
        </div>
        <input type="submit" value="Enviar">
    </form>

    <div class="clear"></div>
    <script src="js/jquery.js"></script>
    <script src="js/cart.js"></script>
</body>

</html>