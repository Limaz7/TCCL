<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user'][0])) {
    header("location:../index.php");
    die();
}

include_once "cruds/conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

$sql_endere = "SELECT * FROM endereco";
$result1 = executarSQL($conexao, $sql_endere);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>

    <?php

    echo "Bem vindo! " . $_SESSION['user'][1] . '<br><br>';

    echo '<a href="logout.php">Sair</a>';

    while ($dados = mysqli_fetch_assoc($result) and $dados1 = mysqli_fetch_assoc($result1)) {
        $arq = $dados['imagem'];

        echo '<h4>' . 'Empresa organizadora: </h4>' .  $dados['nome_empresa'];
        echo '<h4>' . 'Evento: ' . $dados['nome_evento'] . '</h4>';
        echo '<h4>' . 'Descrição: ' . $dados['descricao'] . '</h4>';
        echo '<h4>' . 'data: ' . $dados['data'] . '</h4>';
        echo '<h4>' . 'CEP: ' . $dados1['cep'] . '</h4>';
        echo '<h4>' . 'Número do imóvel: ' . $dados1['numero'] . '</h4>';
        echo '<h4>' . 'Rua: ' . $dados1['rua'] . '</h4>';
        echo '<h4>' . 'Bairro: ' . $dados1['bairro'] . '</h4>';
        echo '<h4>' . 'Cidade: ' . $dados1['cidade'] . '</h4>';
        echo '<h4>' . 'Estado: ' . $dados1['estado'] . '</h4>';

        echo "<td><img src='cruds/imagens/$arq' width='100px' height='100px'></td><br>";

        echo '<h4>' . 'Adicionar comentario:<br>';

        echo '<form action="" method="post">

            <br><textarea name="" id=""></textarea><br>

            <input type="submit" value="Enviar">
        
             </form>';
    }

    ?>

</body>

</html>