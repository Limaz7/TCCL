<?php



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar-senha</title>
</head>
<body>
    <h3> Alterar sua senha </h3>
    <form action="altersenha.php" method="post">
        <label for="senhaAt">
            Senha atual: <input type="text" name="senhaAtual" id="senhaAt">
        </label> <br><br>
        <label for="novaSenha">
            Nova senha: <input type="text" name="novSenha" id="novSenha">
        </label> <br><br>
        <label for="confSenha">
            Confirmar senha: <input type="text" name="confSenha" id="confSenha">
        </label> <br><br>
        <input type="submit" value="Enviar">
    </form>    
</body>
</html>