<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user'][0])) {
    header("location: index.php");
    die();
}

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

$sql_endere = "SELECT * FROM endereco";
$result1 = executarSQL($conexao, $sql_endere);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "headers.php" ?>
    <title>Inicio</title>
</head>

<body>



    <a href="crudperfil/vizuperfil.php"> Vizualizar perfil </a> <br><br>

    <?php

    echo '<a href="logout.php">Sair</a>';

    while ($dados = mysqli_fetch_assoc($result) and $dados1 = mysqli_fetch_assoc($result1)) {
        $arq = $dados['imagem'];

    ?>
        <table class="centered">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Empresa organizadora</th>
                    <th>Evento</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>CEP</th>
                    <th>Número do imóvel</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Adcionar Comentario</th>
                    <th>Comentario</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php
                    echo "<td><img src='cruds/imagens/$arq' width='100px' height='100px'><br></td>";
                    ?>
                    <td><?= $dados['nome_empresa']; ?></td>
                    <td><?= $dados['nome_evento']; ?></td>
                    <td><?= $dados['descricao']; ?></td>
                    <td><?= $dados['data']; ?></td>
                    <td><?= $dados1['cep']; ?></td>
                    <td><?= $dados1['numero']; ?></td>
                    <td><?= $dados1['rua']; ?></td>
                    <td><?= $dados1['bairro']; ?></td>
                    <td><?= $dados1['cidade']; ?></td>
                    <td><?= $dados1['estado']; ?></td>
                    <td><form action="" method="post">
                    <br><textarea name="" id=""></textarea><br>
                    <input type="submit" value="Enviar"></td><h4>Adicionar comentario:</h4><br>
                    </form>
            <?php } ?>

</body>

</html>