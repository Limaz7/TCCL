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

    <table style="text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Validação de entrada</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($result as $results) { ?>
                    <td><?= $results['id_usuario'] ?></td>
                    <td><?= $results['nome'] ?></td>
                    <td><?= $results['email'] ?></td>
                    <td><?= $results['cod_ativacao'] ?></td>
                    <td><a href="formedituser?id_usuario=<?= $results['id_usuario']; ?>">Editar</a></td>
                    <td><a href="">Excluir</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>



</body>

</html>