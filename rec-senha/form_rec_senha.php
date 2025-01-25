<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Formulário de Recuperação de Senha</title>
</head>

<style>
    .buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>

<body>
    <main class="container">
        Digite o endereço de e-mail verificado da sua conta de usuário
        e nós lhe enviaremos um link de redefinição de senha.<br>
        <div class="card-panel">
            <form action="recuperar.php" method="post">
                <label>Email: <input type="email" name="email"></label><br><br>
                <div class="buttons">
                    <a href="../telalogin.php" style="background-color: black;" class="btn waves-effect waves-light lighten-3">Voltar</a>
                    <button type="submit" style="background-color: green" class="btn waves-effect waves-light lighten-3">Enviar email de recuperação</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>