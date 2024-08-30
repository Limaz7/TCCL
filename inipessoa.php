<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION)) {
    header("location: index.php");
    die();
}

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e 
        JOIN enderecos en ON e.id_evento= en.id_evento";
$result = executarSQL($conexao, $sql);

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

    while ($dados = mysqli_fetch_assoc($result)) {
        $arq = $dados['imagem'];

    ?>

        <table>
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
                    <th>Adicionar comentario</th>
                    <th>Vizualizar comentario</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><img src='imagens/<?= $arq ?>' width='100px' height='100px'><br></td>
                    <td><?= $dados['nome_empresa']; ?></td>
                    <td><?= $dados['nome_evento']; ?></td>
                    <td><?= $dados['descricao']; ?></td>
                    <td><?= $dados['data']; ?></td>
                    <td><?= $dados['cep']; ?></td>
                    <td><?= $dados['numero']; ?></td>
                    <td><?= $dados['rua']; ?></td>
                    <td><?= $dados['bairro']; ?></td>
                    <td><?= $dados['cidade']; ?></td>
                    <td><?= $dados['estado']; ?></td>
                    <td>
                        <form action="adccoment" method="post">
                            <br><textarea name="coment"></textarea><br>
                            <input type="submit" value="Enviar">
                        </form>
                    </td>
                <?php } ?>

</body>

</html>