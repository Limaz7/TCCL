<?PHP

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e
        JOIN enderecos en ON e.id_evento= en.id_evento";
$result1 = executarSQL($conexao, $sql);

session_start();

$sql2 = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result2 = executarSQL($conexao, $sql2);
$dados = mysqli_fetch_assoc($result2);

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


    <title>Inicio</title>
</head>

<body>

    <?php include_once "headers.php"; ?>


    <main class="container">

        <h4>
            <?php if ($dados['tipo_usuario'] == 3) { ?>
                <p><a href="crudevento/formcadeventos.php">Cadastrar eventos</a></p>
            <?php } ?>
        </h4>

        <div class="row">

            <?php
            while ($evento = mysqli_fetch_assoc($result1)) {
                $_SESSION['evento'][0] = $evento['id_evento'];
                $arq = $evento['imagem'];
            ?>

                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-image">
                            <img src="imagens/<?= $arq ?>">
                            <span class="card-title" width="200px"><?= $evento['nome_evento']; ?></span>
                        </div>
                        <div class="card-content">
                            <p><?= $evento['descricao']; ?></p>
                            <p>Empresa: </p>
                            <p><?= $evento['nome_empresa']; ?></p>
                            <p>Data do evento: </p>
                            <p><?= $evento['data']; ?></p>
                            <h5>Endereço:</h5>
                            <p><?= $evento['rua']; ?>, <?= $evento['numero']; ?>
                                <?= $evento['bairro']; ?></p>
                            <p>CEP: <?= $evento['cep']; ?></p>
                            </p>
                        </div>
                        <div class="card-action">
                            <?php
                            if ($dados['tipo_usuario'] == 3) {
                                if ($_SESSION['user'][1] == $evento['nome_empresa']) {
                                    echo '<p><a style="color:blue;" href="crudingresso/formcadingresso?id_evento=' . $_SESSION['evento'][0] . '">Cadastrar ingresso</a></p>';
                                    echo '<p><a style="color:blue;" href="crudevento/formediteven?id_evento=' . $_SESSION['evento'][0] . '">Editar evento</a></p>';
                                    echo '<p><a style="color:blue;" href="crudevento/excluireven?id_evento=' . $evento['id_evento'] . '">Excluir evento</a></p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>





    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>

</html>