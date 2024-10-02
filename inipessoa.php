<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION)) {
    header("location: index.php");
    die();
}

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e 
        JOIN enderecos en ON e.id_evento= en.id_evento";
$result = executarSQL($conexao, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>

<body>

    <a href="crudperfil/vizuperfil.php"> Vizualizar perfil </a> <br><br>

    <?php

    echo '<a href="logout.php">Sair</a>';

    ?>

    <main class="container">


        <?php

        while ($dados = mysqli_fetch_assoc($result)) {
            $arq = $dados['imagem'];

        ?>


            <div class="row">

                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-image">
                            <img src="imagens/<?= $arq ?>">
                            <span class="card-title" width="200px"><?= $dados['nome_evento']; ?></span>
                        </div>
                        <div class="card-content">
                            <p><?= $dados['descricao']; ?></p>
                            <p>Empresa: </p>
                            <p><?= $dados['nome_empresa']; ?></p>
                            <p>Data do evento: </p>
                            <p><?= $dados['data']; ?></p>
                            <h5>Endereço:</h5>
                            <p>Rua: <?= $dados['rua']; ?>, <?= $dados['numero']; ?>
                                <?= $dados['bairro']; ?></p>
                            <p>CEP: <?= $dados['cep']; ?></p>
                        </div>
                        <div class="card-action">
                            <a href="ingresso.php">Comprar ingresso</a>
                            <form action="adccoment" method="post">
                                <br><textarea name="coment"></textarea><br>
                                <input type="submit" value="Enviar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>


    </main>

</body>

</html>