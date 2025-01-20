<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Formulário de Recuperação de Senha</title>
</head>

<body>
    <main class="container">
        Digite o endereço de e-mail verificado da sua conta de usuário
        e nós lhe enviaremos um link de redefinição de senha.<br>
        <div class="card-panel">
            <form action="recuperar.php" method="post">
                <label>Email: <input type="email" name="email"></label><br><br>
                <input type="submit" value="Enviar email de recuperação"> <br><br>
                <a href="../index.php">Voltar</a>
            </form>
        </div>
    </main>
</body>

</html>