<?php

session_start();

include("../conexao.php");
$conexao = conectar();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['nome'];
$email = $_POST['email'];
$cadastro = $_POST['cadastro'];
$cod_atv = $_POST['cod_atv'];
$id = $_POST['id'];

$newcadastro = str_replace(['.', '-', '/'], '', $cadastro);

$sql = "UPDATE usuarios SET nome='$nome', email='$email', cadastro='$newcadastro', cod_ativacao='$cod_atv' WHERE id_usuario='$id'";
$execUpdate = executarSQL($conexao, $sql);

$selecUser = "SELECT email, nome, cod_ativacao, tipo_usuario FROM usuarios WHERE id_usuario='$id'";
$execSelect = executarSQL($conexao, $selecUser);
$resultSel = mysqli_fetch_assoc($execSelect);

require_once '../rec-senha/PHPMailer/src/PHPMailer.php';
require_once '../rec-senha/PHPMailer/src/SMTP.php';
require_once '../rec-senha/PHPMailer/src/Exception.php';
include '../config.php';

if ($resultSel['cod_ativacao'] == 1 && $resultSel['tipo_usuario'] == 3) {

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
        $mail->addAddress($resultSel['email'], $resultSel['nome']);     //Add a recipient
        $mail->addReplyTo($config['email'], 'BORA!');

        //Content
        $mail->isHTML(true);        //Set email format to HTML
        $mail->Subject = 'Entrada aprovada';
        $mail->Body = 'Olá!<br>
Sua solicitação de entrada foi aprovada.<br>
Acesse o link abaixo para entrar no sistema:<br>
        <a href="http://' . $_SERVER['SERVER_NAME'] . '/tccl/telalogin.php">Logar</a><br><br>';

        $mail->send();
    } catch (Exception $e) {
        echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
    }
} elseif ($resultSel['cod_ativacao'] == 3 && $resultSel['tipo_usuario'] == 3) {
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
        $mail->addAddress($resultSel['email'], $resultSel['nome']);     //Add a recipient
        $mail->addReplyTo($config['email'], 'BORA!');

        //Content
        $mail->isHTML(true);        //Set email format to HTML
        $mail->Subject = 'Entrada negada';
        $mail->Body = 'Olá!<br>
Sua solicitação de entrada foi negada. Caso tenha dúvidas, entre em contato conosco.';

        $mail->send();
    } catch (Exception $e) {
        echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($nome != $exectUpdate['nome']) {
    unset($_SESSION['user'][1]);
    $_SESSION['user'][1] = $execUpdate['nome'];
}

if ($execUpdate) {
    $_SESSION['mensagem'] = [
        0 => 'Perfil editado com sucesso!',
        1 => '#558b2f light-green darken-3'
    ];
} else {
    $_SESSION['mensagem'] = [
        0 => 'Não foi possível realizar a edição do perfil. Por favor, tente novamente.',
        1 => '#c62828 red darken-3'
    ];
}

header('location: ../telasAdmin/listarUsers.php');
