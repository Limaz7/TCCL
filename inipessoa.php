<?php

session_start();

session_regenerate_id(true);

include_once "cruds/conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

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

    while ($dados = mysqli_fetch_assoc($result)) {

        $arq = $dados['imagem'];

        echo '<h4>' . 'Empresa organizadora: </h4>' .  $dados['nome_empresa'];
        echo '<h4>' . 'Evento: ' . $dados['nome_evento'] . '</h4>';
        echo '<h4>' . 'Descrição: ' . $dados['descricao'] . '</h4>';
        echo '<h4>' . 'data: ' . $dados['data'] . '</h4>';
        echo '<h4>' . 'Comentarios: ' . $dados['comentario'] . '</h4>';

        echo "<td><img src='cruds/imagens/$arq' width='100px' height='100px'></td><br>";

        echo '<h4>' . 'Adicionar comentario:<br>';

        echo '<form action="" method="post">

            <br><textarea name="" id=""></textarea><br>

            <input type="submit" value="Enviar"
        
             </form>';
    }

    ?>

</body>

</html>