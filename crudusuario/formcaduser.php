<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
</head>

<body>


    <div class="container">
        <form action="cadastrouser.php" method="post">
            <h2 class="center-align"> Cadastre-se </h2>
            <br>

            <div class="card-panel">
                <div class="col s12">
                    <p>
                        <label>
                            <input class="with-gap" name="eoq" value="3" type="radio" />
                            <span>Empresa</span>
                        </label>

                        <br><br>

                        <label>
                            <input class="with-gap" name="eoq" value="2" type="radio" />
                            <span>Pessoa</span>
                        </label>
                    </p>
                </div>
                <br>

                <div class="input-field col s10 offset-s1">
                    <input id="nome" type="text" name="nome" class="validate" pattern="[A-z\s\W]+" required>
                    <label for="nome">Nome</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="email" type="email" name="email" class="validate" pattern="/^\w*+@\w*+\.[a-z]+\(\.[a-z]+)+$/i" required>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="senha" type="password" name="senha" class="validate" required>
                    <label for="senha">Senha</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>

                <div class="col s12">
                    <p class="center-align">
                        <button class="btn waves-effect waves-light black lighten-3" type="submit" name="action">Cadastrar
                    </p>
                </div>
            </div>
        </form>
    </div>


</body>


<!--JavaScript at end of body for optimized loading-->
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