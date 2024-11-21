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

    <p><a href="../logout.php">Sair</a></p>

    <table style="text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Validação de entrada</th>
                <th>Tipo de usuário</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($result as $results) { ?>
                    <?php if ($results['id_usuario'] > 1) { ?>
                        <td><?= $results['id_usuario'] ?></td>
                        <td><?= $results['nome'] ?></td>
                        <td><?= $results['email'] ?></td>
                        <td><?= $results['cod_ativacao'] ?></td>
                        <td><?= $results['tipo_usuario'] ?> </td>
                        <td><a href="formedituser?id_usuario=<?= $results['id_usuario']; ?>">Editar</a></td>
                        <td><a href="excluiruser?id_usuario=<?= $results['id_usuario']; ?>">Excluir</a></td>
                    <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <hr>
    <p>Tipo de usuário:</p>
    <p>2 - Participante</p>
    <p>3 - Empresa</p>



</body>

</html>