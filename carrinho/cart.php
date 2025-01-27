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

<style>
    .container_top .container_top_paragraph button{
        background-color:rgb(0, 0, 0);
        color: #ffffff;
        padding: 20px 40px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }

    .container_top .container_top_paragraph button:hover {
        background-color:rgb(255, 255, 255);
        color: #000000;
    }
</style>

<body>
    <div class="result"></div>
    <article class="container_top">
        <p class="container_top_paragraph"><a style="background-color: black" href="../index.php"><span class="fa fa-caret-square-left"></span> VOLTAR À LOJA</a></p>
    </article>

    <form action="compraringresso.php" method="POST">
        <div id="cart">
            <?php require 'cartLoader.php' ?>
        </div>
        <article class="container_top">
            <p class="container_top_paragraph"><button><span class="fa fa-caret-square-right"></span>Comprar</button></p>
        </article>
    </form>

    <div class="clear"></div>
    <script src="js/jquery.js"></script>
    <script src="js/cart.js"></script>
</body>

</html>