<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../telalogin.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alterar-senha</title>
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
</style>

<body>

    <main class="container">

        <div class="card-panel">
            <h3 class="center"> Alterar sua senha </h3>
            <form action="alterarPass.php" method="post">

                <label for="senhaAt">
                    Senha atual: <input type="password" name="senhaAtual" id="senhaAt" required>
                </label> <br><br>

                <label for="novSenha">
                    Nova senha: <input type="password" class="validate" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" name="novSenha" id="novSenha" required>
                    <span class="helper-text" data-error="A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial."></span>
                </label> <br><br>

                <label for="confSenha">
                    Confirmar senha: <input type="password" class="validate" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" name="confSenha" id="confSenha" required>
                    <span class="helper-text" data-error="A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial."></span>
                </label> <br><br>

                <div class="buttons">
                    <a href="vizuperfil.php" class="black waves-effect waves-green btn">voltar</a>
                    <button type="submit" class="waves-effect waves-green btn green">Enviar</button>
                </div>

            </form>
        </div>

    </main>

</body>

<script type="text/javascript" src="../js/materialize.min.js"></script>

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