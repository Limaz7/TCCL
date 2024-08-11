<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Cadastro</title>
</head>

<body class="bodyform">
    <div class="boxcad">
        <form action="cadastrouser.php" method="post">
            <h2> Cadastre-se </h2>
            Empresa: <input type="radio" name="eoq" value="1">
            Pessoa: <input type="radio" name="eoq" value="0">
            <div class="boxinput">
                <input type="text" name="nome" required>
                <span>Nome</span>
                <i></i>
            </div>
            <div class="boxinput">
                <input type="text" name="email" required>
                <span>Email</span>
                <i></i>
            </div>
            <div class="boxinput">
                <input type="password" name="senha" required>
                <span>Senha</span>
                <i></i>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>