<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <form action="cadastrouser.php" method="post">

        <h1> Cadastre-se </h1>

        Empresa: <input type="radio" name="eoq" value="1">
        Pessoa: <input type="radio" name="eoq" value="0"> <br><br>
        <label for="nome"> Nome:
            <input type="text" name="nome"> <br><br>
        </label>
        <label for="email"> Email:
            <input type="text" name="email"> <br><br>
        </label>
        <label for="senha"> Senha:
            <input type="password" name="senha"> <br><br>
        </label>

        <input type="submit" value="Enviar">

    </form>
</body>

</html>