<?php

session_start();

require_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <title>Cadastrar eventos</title>
</head>

<body>

    <h1> Cadastrar eventos </h1>

    <form method="post" action="cadastroeven.php" enctype="multipart/form-data">


        <input type="hidden" name="nomeEmp" value="<?php echo $_SESSION['user'][1]; ?>">
        <p>Nome do evento: <input type="text" name="nomeEven" required></p>
        <p>Descrição: <textarea type="text" name="desc" required></textarea></p>
        <p>CEP: <input type="number" name="cep" required></p>
        <p>Rua: <input type="text" name="rua" required></p>
        <p>Número do imóvel: <input type="number" name="numImo" required></p>
        <p>Bairro: <input type="text" name="bairro" required></p>
        <p>Cidade: <input type="text" name="cidade" required></p>
        <p>Estado: <input type="text" name="estado" required></p>
        <p>Data: <input type="datetime-local" name="data" required></p>
        <p>Imagem <input type="file" name="arquivo">
        <p><input type="submit" value="Enviar"></p>


    </form>
</body>

</html>