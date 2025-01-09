<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

$id = $_GET['id_evento'];

include "../conexao.php";
$conexao = conectar();

$sql_all = "SELECT * FROM eventos WHERE id_evento = '$id'";

$resultado = executarSQL($conexao, $sql_all);

$dados = mysqli_fetch_assoc($resultado);

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
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

<body>

    <div class="container">
        <h1> EDITAR EVENTOS </h1>

        <form method="post" action="editareven.php" enctype="multipart/form-data">

            <input type="hidden" value="<?= $dados['imagem']; ?>" name="antfoto" />
            <input type="hidden" value="<?= $id; ?>" name="id" />
            Nome: <input type="text" value="<?= $dados['nome_evento']; ?>" name="nome" /> <br>
            Descrição: <input type="text" value="<?= $dados['descricao']; ?>" name="desc" /><br>
            Data: <input type="datetime-local" value="<?= $dados['data']; ?>" name="data" /> <br>
            CEP: <input type="number" value="<?= $dados['cep']; ?>" name="cep" /> <br>
            Número do imóvel: <input type="number" value="<?= $dados['numero_residencial']; ?>" name="numImo" /> <br>
            Rua: <input type="text" value="<?= $dados['rua']; ?>" name="rua" /> <br>
            Bairro: <input type="text" value="<?= $dados['bairro']; ?>" name="bairro" /> <br>
            Imagem: <input type="file" value="<?= $dados['imagem']; ?>" name="img" /> <br>

            <p><input type="submit" value="Enviar"></p>
        </form>
    </div>
</body>

</html>