<!DOCTYPE html>
<html>

<head>
   
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