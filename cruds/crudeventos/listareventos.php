<?php


include "../conexao.php";
$conecta = conectar();

$sql = "SELECT * FROM eventos";

$resultado = executarSQL($conecta, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar eventos</title>
</head>

<body>

    <h1> CRUD EVENTOS </h1>

    <h5>
        <p><a href="formeventos.php">Cadastrar eventos</a></p>
    </h5>

    <?php
    while($dados = mysqli_fetch_assoc($resultado)){
        $arq = $dados['imagem'];

        echo '<h4>' . 'nome da empresa organizadora: </h4>' .  $dados['nome_empresa'];
        echo '<h4>' . 'nome: ' . $dados['nome'] . '</h4>';
        echo '<h4>' . 'Descrição: ' . $dados['descricao'] . '</h4>';
        echo '<h4>' . 'data: ' . $dados['data'] . '</h4>';

        echo "<td><img src='../imagens/$arq' width='100px' height='100px'></td>";;
    }
    ?>
</body>

</html>