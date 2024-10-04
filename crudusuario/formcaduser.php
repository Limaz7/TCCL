<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    Import materialize.css
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    Let browser know website is optimized for mobile
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>Cadastro</title>
</head>

<body>


    <div class="container">
        <form action="cadastrouser.php" method="post">
            <h2> Cadastre-se </h2>
            <span>Empresa: </span>
            <input type="radio" name="eoq" value="3">
            <span>Pessoa:</span>
            <input type="radio" name="eoq" value="2">
            <span>Nome</span>
            <input type="text" name="nome" required>
            <span>Email</span>
            <input type="text" name="email" required>
            <span>Senha</span>
            <input type="password" name="senha" required>
            <input type="submit" value="Enviar">
        </form>
    </div>


</body>


<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="../js/materialize.min.js"></script>

</html>