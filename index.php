<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<style>
    .card-panel {
        position: fixed;
        background-color: rgb(238, 238, 238);
        padding: 20px;
        border-radius: 8px;
        top: 30%;
        right: 40%;
    }

    .card-panel button {
        width: 100%;
    }
</style>

<body>

    <div class="container">
        <form action="login.php" method="post">

            <div class="card-panel">

                <div class="input-field col s10 offset-s1">
                    <input type="text" id="email" name="email" class="validade" required>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="senha" type="password" name="senha" class="validate" required>
                    <label for="senha">Senha</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>


                <a href="crudusuario/formcaduser.php">Não tem conta? cadastre-se!</a><br>
                <a href="rec-senha/form_rec_senha.php">Esqueceu a senha da sua conta? Recupere-a </a><br>

                <div class="col s12">
                    <p class="center-align">
                        <button class="btn waves-effect waves-light black lighten-3" type="submit" name="action">Logar</button>
                    </p>
                </div>

            </div>
        </form>
    </div>
</body>




<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>

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