<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1> Bem vindo! Faça o login.</h1>
    <form action="login.php" method="post">
        <label for="nome">
            Nome: <input type="text" name="nome" > <br>
        </label>
        <label for="email">
            Email: <input type="text" name="email"> <br>
        </label>
        <label for="senha">
            Senha: <input type="password" name="senha"> <br> <br>
        </label>
        <input type="submit" value="Enviar"> <br><br>
        <a href="cruds/formcaduser.php">Não tem conta? cadastre-se! </a>
    </form>
</body>

</html>