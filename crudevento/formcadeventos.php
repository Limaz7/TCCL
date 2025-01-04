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

<body>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

<body>

    <div class="container">
        <h1> Cadastrar eventos </h1>

        <form method="post" action="cadastroeven.php" enctype="multipart/form-data">


            <input type="hidden" name="nomeEmp" value="<?php echo $_SESSION['user'][1]; ?>">
            <p>Nome do evento: <input type="text" name="nomeEven" required></p>
            <p>Descrição: <textarea type="text" name="desc" required></textarea></p>
            <p>CEP: <input type="number" name="cep" required></p>
            <p>Rua: <input type="text" name="rua" required></p>
            <p>Número do imóvel: <input type="number" name="numImo" required></p>
            <p>Bairro: <input type="text" name="bairro" required></p>
            <p>Data: <input type="datetime-local" name="data" required></p>
            <p>Imagem <input type="file" name="arquivo">
            <p><input type="submit" value="Enviar"></p>


        </form>
    </div>
</body>

</html>