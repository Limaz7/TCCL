<?php

session_start();

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Editar perfil</title>
</head>
<body>
    <h1> Edite seu perfil </h1>
    <a href="formalterarsenha.php"> Alterar sua senha </a> <br><br>
    <form action="editperf.php" method="post">
        <label for="nome">
            Nome: <input type="text" name="nome" id="nome" value="<?= $dados['nome']; ?>">
        </label> <br> <br>
        <label for="email">
            Email: <input type="text" name="email" id="email" value="<?= $dados['email']; ?>">
        </label> <br> 
        <p><a href="excluirperfil.php">Excluir seu perfil</a></p>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>