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
    <title>Nova senha</title>
</head>

<body>
    <form action="salvar_nova_senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        Email: <?= $email ?><br>
        <label>Senha: <input type="password" name="senha"></label><br>
        <label>Repita a senha: <input type="password" name="repetirSenha"></label><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>