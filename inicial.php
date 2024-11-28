<?PHP

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result1 = executarSQL($conexao, $sql);

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

    <?php include_once "Navs/headers.php"; ?>


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
                            <img class="materialboxed" src="imagens/<?= $arq ?>" height="200">
                        </div>
                        <div class="card-content">
                            <p><?= $evento['nome_evento']; ?></p>
                            <p><?= $evento['descricao']; ?></p>
                            <p>Empresa: </p>
                            <p><?= $evento['produtora']; ?></p>
                            <p>Data do evento: </p>
                            <p><?= $evento['data']; ?></p>
                        </div>
                        <div class="card-action">
                            <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='informacoes?id_evento=<?= $evento["id_evento"] ?>'>Mais informações</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>





    </main>


    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox(); // Inicializando o materialbox
            $('.modal').modal(); // Inicializando os modais
        });
    </script>


</body>

</html>