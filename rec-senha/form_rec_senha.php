<?php session_start(); ?>

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
    body,
    html {
        height: 100%;
        margin: 0;
    }

    main.container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Alinha verticalmente ao centro ocupando toda a altura */
    }

    .card-panel {
        width: 40%;
        padding: 20px;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .card-panel span{
        font-size: 15px;
        font-style: italic;
    }
</style>

<body>
    <main class="container">


        <div class="card-panel">
            <span>Digite o endereço de e-mail verificado da sua conta de usuário e enviaremos um link para redefinição de senha.</span>
            <form action="recuperar.php" method="post">
                <label>Email: <input type="email" name="email"></label><br><br>
                <div class="buttons">
                    <a href="../telalogin.php" style="background-color: black;" class="btn waves-effect waves-light">Voltar</a>
                    <button type="submit" class="green waves-effect waves-light btn">Enviar e-mail de recuperação</button>
                </div>
            </form>
        </div>


    </main>
</body>

<script src="../js/materialize.min.js"></script>

<script>
    <?php if (isset($_SESSION['mensagem'])): ?>
        M.toast({
            html: '<?= $_SESSION['mensagem'][0] ?>',
            classes: '<?= $_SESSION['mensagem'][1] ?>'
        });

    <?php unset($_SESSION['mensagem']);
    endif; ?>
</script>

</html>