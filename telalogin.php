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
        padding: 20px;
        border-radius: 8px;
        top: 30%;
        right: 40%;
    }

    .card-panel button {
        width: 100%;
    }

    .card-panel .text-inic{
        position: relative;
        font-size: 30px;
        text-align: center;
    }

    .card-panel .text-cad-rec{
        color: gray;
        font-style: italic;
        margin-right: 5px;
    }
</style>

<body>

    <div class="container">
        <form action="login.php" method="post">

            <div class="card-panel">

                <span class="text-inic">Login</span>

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

                <p><a href="index.php">Acessar a tela inicial</a></p>
                <span class="text-cad-rec">Não tem conta?</span><a href="crudusuario/formcaduser.php">cadastre-se!</a><br>
                <span class="text-cad-rec">Esqueceu a senha da sua conta?</span><a href="rec-senha/form_rec_senha.php">Recupere-a </a><br>

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