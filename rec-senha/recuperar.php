<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../conexao.php";
$conexao = conectar();

session_start();

$email = $_POST['email'];
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);
if ($usuario == null) {
    $_SESSION['mensagem'] = [
        0 => 'E-mail não cadastrado! Por favor, faça o cadastro e, em seguida, realize o login.',
        1 => '#c62828 red darken-3'
    ];
    header('location: form_rec_senha.php');
    die();
}
//gerar um token unico
$token = bin2hex(random_bytes(50));

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
include '../config.php';


$mail = new PHPMailer(true);
try {
    // configurações
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('br');
    //$mail->SMTPDebug = SMTP::DEBUG_OFF;  //tira as mensagens de erro
    $mail->isSMTP();                       //envia o email usando SMTP
    $mail->Host = 'smtp.gmail.com';        //Set the SMTP server to send through
    $mail->SMTPAuth = true;                //Enable SMTP authentication
    $mail->Username = $config['email'];    //SMTP username
    $mail->Password = $config['senha_email']; //SMTP password
    //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    /* TCP port to connect to; use 587 if you have set 
    `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS` */
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom($config['email'], 'Não responda!');
    $mail->addAddress($usuario['email'], $usuario['nome']);     //Add a recipient
    $mail->addReplyTo($config['email'], 'Sistema de gerenciamento de eventos culturais');

    //Content
    $mail->isHTML(true);        //Set email format to HTML
    $mail->Subject = 'Recuperação de Senha do Sistema';
    $mail->Body = 'Olá!<br>
Você solicitou a recuperação de sua conta em nosso sistema.<br>
Para concluir, clique no link abaixo e realize a troca de senha:<br>
        <a href="http://' . $_SERVER['SERVER_NAME'] . '/tccl/rec-senha/nova_senha.php?email=' . $usuario['email'] .
        '&token=' . $token .
        '">Clique aqui para recuperar o acesso à sua conta!</a><br>
        <br>
        Atenciosamente<br>
        Equipe do sistema...';

    $mail->send();

    // Gravar as informações na tabela recuperar senha
    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');

    $sql2 = "INSERT INTO recuperar_senha
            (email, token, data_criacao, usado) 
            VALUES ('" . $usuario['email'] . "', '$token', 
            '$agora', 0)";
    executarSQL($conexao, $sql2);

    $_SESSION['mensagem'] = [
        0 => 'Email enviado com sucesso! Por favor, confira sua caixa de entrada.',
        1 => '#558b2f light-green darken-3'
    ];

    header('location: ../telalogin.php');
    exit();
} catch (Exception $e) {
    echo "Não foi possível enviar o e-mail. Erro no envio: {$mail->ErrorInfo}";
}
