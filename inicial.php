<?PHP

session_start();

if (!isset($_SESSION)) {
    header('location: index.php');
}

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.*, i.* FROM eventos e
        JOIN enderecos en ON e.id_evento= en.id_evento LEFT JOIN ingressos i ON e.id_evento = i.id_evento";
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
                            <img class="materialboxed" src="imagens/<?= $arq ?>" width="300">
                            <span class="card-title" width="200px"><?= $evento['nome_evento']; ?></span>
                        </div>
                        <div class="card-content">
                            <p><?= $evento['descricao']; ?></p>
                            <p>Empresa: </p>
                            <p><?= $evento['nome_empresa']; ?></p>
                            <p>Data do evento: </p>
                            <p><?= $evento['data']; ?></p>
                            <p>Valor do ingresso: R$ <?= $evento['valor']; ?></p>
                            <h5>Endereço:</h5>
                            <p><?= $evento['rua']; ?>, <?= $evento['numero']; ?>
                                <?= $evento['bairro']; ?></p>
                            <p>CEP: <?= $evento['cep']; ?></p>
                            </p>
                            <!-- Modal Trigger -->

                        </div>
                        <div class="card-action">
                            <?php
                            if ($dados['tipo_usuario'] == 2) { ?>
                                <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href="#modal<?= $evento['id_evento']; ?>">Comprar Ingresso</a>

                            <!-- Modal Structure -->
                            <div id="modal<?= $evento['id_evento']; ?>" class="modal">
                                <div class="modal-content">
                                    <h4>Comprar Ingresso</h4>
                                    <form action="compraringresso.php" method="post">
                                        <input type="hidden" name="id_ev" value="<?= $evento['id_evento']; ?>">
                                        <input type="hidden" name="id_in" value="<?= $evento['id_ingresso']; ?>">
                                        <p>Quantidade: <input type="number" name="qtd" required></p>
                                        <div class="modal-footer">
                                            <a href="#!" style="background: red;" class="modal-close waves-effect waves-red btn">Cancelar</a>
                                            <button style="background: green;" type="submit" class="waves-effect waves-green btn">Comprar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php }
                            if ($dados['tipo_usuario'] == 3) {
                                if ($_SESSION['user'][1] == $evento['nome_empresa']) {
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