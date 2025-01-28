<?php

//verificar email
//verificar token
$email = $_GET['email'];
$token = $_GET['token'];

require_once "../conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM recuperar_senha WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);
if ($resultado == null) {
    echo "Email ou token incorretos. Por favor, tente fazer um novo pedido de recuperação de senha.";
    echo "<a href='form_rec_senha.php'>Voltar</a>";
    die();
} else {
    // verificar a validade do pedido (data_criacao)
    // verificar se o link ja foi usado
    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $data_criacao = DateTime::createFromFormat(
        'Y-m-d H:i:s',
        $recuperar['data_criacao']
    );
    $UmDia = DateInterval::createFromDateString(('1 day'));
    $dataExpiracao = date_add($data_criacao, $UmDia);

    if ($data > $dataExpiracao) {
        $_SESSION['mensagem'] = [
            0 => 'SEsta solicitação de recuperação de senha expirou. Por favor, faça um novo pedido de recuperação de senha.',
            1 => '#c62828 red darken-3'
        ];
        header('location: form_rec_senha.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Nova senha</title>
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

    .card-panel span {
        font-size: 15px;
        font-style: italic;
    }
</style>

<body>
    <main class="container">
        <div class="card-panel">
            <form action="salvar_nova_senha.php" method="post">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <span>Email: <?= $email ?></span> <br>

                <label for="senha">
                    Senha: <input id="senha" type="password" name="senha" class="validate"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" required>
                    <span class="helper-text" data-error="A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial."></span>
                </label><br>

                <label>Repita a senha: <input type="password" name="repetirSenha"></label><br>
                <button class="green waves-effect waves-light btn" type="submit">Enviar</button>
            </form>
        </div>
    </main>
</body>

<script type="text/javascript" src="../js/materialize.min.js"></script>

</html>