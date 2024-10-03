<?PHP

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e 
        JOIN enderecos en ON e.id_evento= en.id_evento";
$result = executarSQL($conexao, $sql);

session_start();

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

<style>

#links {
    color: black;
}

</style>

<body>

    <?php include_once "headers.php"; ?>

    <h4>
        <p><a href="crudevento/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>
    <main class="container">

        <?php
        while ($dados = mysqli_fetch_assoc($result)) {
            $_SESSION['evento'][0] = $dados['id_evento'];
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
                            <p>Empresa: </p><p><?= $dados['nome_empresa']; ?></p>          
                            <p>Data do evento: </p><p><?= $dados['data']; ?></p>
                            <h5>Endereço:</h5>
                            <p><?= $dados['rua']; ?>, <?= $dados['numero']; ?>
                                <?= $dados['bairro']; ?></p>
                            <p>CEP: <?= $dados['cep']; ?></p>
                            </p>
                        </div>
                        <div class="card-action">
                            <?php
                            if ($_SESSION['user'][1] == $dados['nome_empresa']) {
                                echo '<p><a style="color:blue;" href="crudingresso/formcadingresso?id_evento=' . $_SESSION['evento'][0] . '">Cadastrar ingresso</a></p>';
                                echo '<p><a style="color:blue;" href="crudevento/formediteven?id_evento=' . $_SESSION['evento'][0] . '">Editar evento</a></p>';
                                echo '<p><a style="color:blue;" href="crudevento/excluireven?id_evento=' . $dados['id_evento'] . '">Excluir evento</a></p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>





    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>

</html>