<?php

session_start();
$id = $_SESSION['evento'][0];

include "../conexao.php";
$conexao = conectar();

$sql_even = "SELECT * FROM eventos WHERE id_evento = '$id'";

$sql_endere = "SELECT * FROM enderecos WHERE id_evento = '$id'";

$resultado = executarSQL($conexao, $sql_even);
$result = executarSQL($conexao, $sql_endere);

$dados = mysqli_fetch_assoc($resultado);
$dados1 = mysqli_fetch_assoc($result);

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
        <h1> EDITAR EVENTOS </h1>

        <form method="post" action="editareven.php" enctype="multipart/form-data">

            <input type="hidden" value="<?php echo $dados['imagem']; ?>" name="antfoto" />
            <input type="hidden" value="<?php echo $_SESSION['evento'][0]; ?>" name="id" />
            Nome: <input type="text" value="<?php echo $dados['nome_evento']; ?>" name="nome" /> <br>
            Descrição: <input type="text" value="<?php echo $dados['descricao']; ?>" name="desc" /><br>
            Imagem: <input type="file" value="<?php echo $dados['imagem']; ?>" name="img" /> <br>
            Data: <input type="datetime-local" value="<?php echo $dados['data']; ?>" name="data" /> <br>
            CEP: <input type="number" value="<?php echo $dados1['cep']; ?>" name="cep" /> <br>
            Número do imóvel: <input type="number" value="<?php echo $dados1['numero']; ?>" name="numImo" /> <br>
            Rua: <input type="text" value="<?php echo $dados1['rua']; ?>" name="rua" /> <br>
            Bairro: <input type="text" value="<?php echo $dados1['bairro']; ?>" name="bairro" /> <br>

            <p><input type="submit" value="Enviar"></p>
        </form>
    </div>
</body>

</html>