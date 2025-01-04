<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Alterar-senha</title>
</head>
<body>
    <h3> Alterar sua senha </h3>
    <form action="alterarSenha.php" method="post">
        <label for="senhaAt">
            Senha atual: <input type="text" name="senhaAtual" id="senhaAt">
        </label> <br><br>
        <label for="novSenha">
            Nova senha: <input type="text" name="novSenha" id="novSenha">
        </label> <br><br>
        <label for="confSenha">
            Confirmar senha: <input type="text" name="confSenha" id="confSenha">
        </label> <br><br>
        <input type="submit" value="Enviar">
    </form>    
</body>
</html>