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

<style>
    .card-panel span{
        font-size: 35px;
        text-align: center;
    }
</style>

<body>


    <div class="container">
        <form action="cadastrouser.php" method="post">
            <br>

            <div class="card-panel">
                <span>Cadastro</span>
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
                    <input id="nome" type="text" name="nome" class="validate" pattern="[A-Za-zÀ-ÿ\s\.]+" required>
                    <label for="nome">Nome</label>
                    <span class="helper-text" data-error="Campo com preenchimento obrigatório."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="email" type="email" name="email" class="validate" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Insira um email válido, como exemplo@dominio.com."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="senha" type="password" name="senha" class="validate"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" required>
                    <label for="senha">Senha</label>
                    <span class="helper-text" data-error="A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial."></span>
                </div>

                <div class="input-field col s10 offset-s1">
                    <input id="cadastro" type="text" name="cadastro" class="validate"
                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}|\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" required>
                    <label for="cadastro">CPF ou CNPJ</label>
                    <span class="helper-text" data-error="Insira um CPF no formato 000.000.000-00 ou CNPJ no formato 00.000.000/0000-00."></span>
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