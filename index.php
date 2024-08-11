<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "headers.php" ?>
    <title>Login</title>
</head>

<body class="bodyform">
    <div class="boxlogin">
        <form action="login.php" method="post">
            <h2> Bem-vindo! Faça o login.</h2>
            <div class="boxinput">
                <input type="text" name="nome" required>
                <span>Nome</span>
                <i></i>
            </div>
            <div class="boxinput">
                <input type="text" name="email" required>
                <span>Email</span>
                <i></i>
            </div>
            <div class="boxinputsenha">
                <input type="password" name="senha" id="password" required>
                <span>Senha</span>
                <i></i>
            </div>
            <div id="icon" onclick="showHide()"></div>
            <div class="links">
                <a href="cruds/formcaduser.php">Não tem conta? cadastre-se!</a>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <script src="script/script.js"></script>
</body>

</html>