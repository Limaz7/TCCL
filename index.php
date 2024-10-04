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

<body>

    <div class="container">
        <form action="login.php" method="post">
            <h2> Bem-vindo! Faça o login.</h2>
            <span>Email</span>  
            <input type="text" name="email" required>
            <span>Senha</span>
            <input type="password" name="senha" id="password" required>
            <a href="crudusuario/formcaduser.php">Não tem conta? cadastre-se!</a><br>
            <a href="rec-senha/form_rec_senha.php">Esqueceu a senha da sua conta? Recupere-a </a><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>




<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>

</html>