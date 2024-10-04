<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Recuperação de Senha</title>
</head>

<body>
    Digite o endereço de e-mail verificado da sua conta de usuário
    e nós lhe enviaremos um link de redefinição de senha.<br>
    <form action="recuperar.php" method="post">
        <label>Email: <input type="email" name="email"></label><br><br>
        <input type="submit" value="Enviar email de recuperação"> <br><br>
        <a href="../index.php">Voltar</a>
    </form>
</body>

</html>