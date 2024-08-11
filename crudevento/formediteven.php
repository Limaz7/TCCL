<?php

session_start();
$id = $_SESSION['evento'][0];

include "../conexao.php";
$conexao = conectar();

$sql_even = "SELECT * FROM eventos WHERE id_eventos = '$id'";

$sql_endere = "SELECT * FROM endereco WHERE id_eventos = '$id'";

$resultado = executarSQL($conexao, $sql_even);
$result = executarSQL($conexao, $sql_endere);

$dados = mysqli_fetch_assoc($resultado);
$dados1 = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <title>Editar eventos</title>
</head>

<body>

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
        Cidade: <input type="text" value="<?php echo $dados1['cidade']; ?>" name="cidade" /> <br>
        Estado: <input type="text" value="<?php echo $dados1['estado']; ?>" name="estado" /> <br>

        <p><input type="submit" value="Enviar"></p>
    </form>
</body>

</html>