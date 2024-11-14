<?php

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
$result = executarSQL($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Tela administrador</h1>

    <form action="alteravalidacao.php" method="post">
        <table style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Validação de entrada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($result as $results) { ?>
                        <?php if ($results['id_usuario'] > 1) { ?>
                            <td><?= $results['id_usuario'] ?></td>
                            <td><?= $results['nome'] ?></td>
                            <td><?= $results['email'] ?></td>
                            <td>
                                <select name="cod_atv">
                                    <option value="1">1 - Acesso liberado</option>
                                    <option value="2">2 - Em analise</option>
                                    <option value="3">3 - Acesso negado</option>
                                </select>
                            </td>
                        <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
    <input type="submit" value="Salvar informações">



</body>

</html>