<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

require_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<style>
    .btn-enviar {
        width: 100%;
        background-color: black;
    }

    .btn-enviar:hover {
        background-color: #eeeeee;
        color: black
    }

    .card-panel {
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 20px 30px;
    }
</style>

<body>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

<body>

    <div class="container">

        <div class="card-panel">
            <div class="row">
                <form method="post" class="col s12" action="cadastroeven.php" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="nomeEmp" value="<?php echo $_SESSION['user'][1]; ?>">

                        <div class="input-field col s12">
                            <p>Nome do evento: <input type="text" name="nomeEven" required></p>
                        </div>

                        <div class="input-field col s12">
                            <p>Descrição: <textarea type="text" name="desc" required></textarea></p>

                            <div class="input-field col s12">
                                <p>CEP: <input type="number" name="cep" required></p>
                            </div>

                            <div class="input-field col s12">
                                <p>Rua: <input type="text" name="rua" required></p>
                            </div>

                            <div class="input-field col s12">
                                <p>Número do imóvel: <input type="number" name="numImo" required></p>
                            </div>

                            <div class="input-field col s12">
                                <p>Bairro: <input type="text" name="bairro" required></p>
                            </div>

                            <div class="input-field col s12">
                                <p>Data: <input class="btn-datetime" type="datetime-local" name="data" required></p>
                            </div>

                            <div class="input-field col s12">
                                <p>Imagem <input type="file" class="btn" name="arquivo"></p>
                            </div>

                            <p><input class="waves-effect waves-light btn-enviar btn" type="submit" value="Enviar"></p>
                        </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>