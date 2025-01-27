<?php

$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];
$repetirSenha = $_POST['repetirSenha'];

$hash = password_hash($senha, PASSWORD_ARGON2I);

require_once "../conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM recuperar_senha WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);
if ($resultado == null) {
    $_SESSION['mensagem'] = [
        0 => 'E-mail ou token incorretos. Por favor, tente fazer um novo pedido de recuperação de senha.',
        1 => '#c62828 red darken-3'
    ];
    header('location: form_rec_senha.php');
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
            0 => 'Esta solicitação de recuperação de senha expirou. Por favor, faça um novo pedido de recuperação.',
            1 => '#c62828 red darken-3'
        ];
        header('location: form_rec_senha.php');
        die();
    }

    if ($recuperar['usado'] == 1) {
        $_SESSION['mensagem'] = [
            0 => 'Este pedido de recuperação de senha já foi utilizado anteriormente. Para recuperar sua senha, faça um novo pedido.',
            1 => '#c62828 red darken-3'
        ];
        header('location: form_rec_senha.php');
    }

    if ($senha != $repetirSenha) {
        $_SESSION['mensagem'] = [
            0 => 'As senhas não coincidem. Tente novamente.',
            1 => '#c62828 red darken-3'
        ];
        header('location: form_rec_senha.php');
        die();
    }


    $updateUser = "UPDATE usuarios SET senha = '$hash' 
             WHERE email = '$email'";
    $execUpdtUser = executarSQL($conexao, $updateUser);
    $updateRecPass = "UPDATE recuperar_senha SET usado=1 
             WHERE email='$email' AND token='$token'";
    $execUpdtRecPass = executarSQL($conexao, $updateRecPass);

    if ($execUpdtRecPass && $execUpdtUser) {
        $_SESSION['mensagem'] = [
            0 => 'Nova senha cadastrada com sucesso! Faça o login
    para acessar o sistema.',
            1 => '#558b2f light-green darken-3'
        ];
        header('location: ../telalogin.php');
        die();
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possível cadastrar a nova senha. Por favor, tente novamente.',
            1 => '#c62828 red darken-3'
        ];
        header('location: ../salvar_nova_senha.php');
        die();
    }
}
