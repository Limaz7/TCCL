<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
$result = executarSQL($conexao, $sql);

$eoq = $_POST['eoq'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$cadastro = $_POST['cadastro'];

require_once '../rec-senha/PHPMailer/src/PHPMailer.php';
require_once '../rec-senha/PHPMailer/src/SMTP.php';
require_once '../rec-senha/PHPMailer/src/Exception.php';
include '../config.php';

$newcadastro = str_replace(['.', '-', '/'], '', $cadastro);

$hash = password_hash($senha, PASSWORD_ARGON2I);

while ($dados = mysqli_fetch_assoc($result)) {

    if ($nome == $dados['nome']) {
        $_SESSION['mensagem'] = [
            0 => 'Já existe um usuário com esse nome! Tente se cadastrar com outro nome.',
            1 => '#c62828 red darken-3'
        ];
        header('location: formcaduser.php');
        exit();
    }

    if ($email == $dados['email']) {
        $_SESSION['mensagem'] = [
            0 => 'O email já existe, tente se cadastrar com outro email.',
            1 => '#c62828 red darken-3'
        ];
        header('location: formcaduser.php');
        die();
    }
}


if ($eoq == 3) {

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
        $mail->addAddress($config['email']);     //Add a recipient
        $mail->addReplyTo($config['email'], 'BORA!');

        //Content
        $mail->isHTML(true);        //Set email format to HTML
        $mail->Subject = 'Validar a empresa';
        $mail->Body = 'Olá!<br>
        Há uma solicitação de entrada em analise.
        Para validar ou negar sua entrada, clique no link abaixo:<br>
        <a href="http://' . $_SERVER['SERVER_NAME'] . '/tccl/index.php">Validar</a><br><br>';

        $mail->send();

        $sql = "INSERT INTO usuarios (nome, email, senha, cadastro, tipo_cadastro, tipo_usuario, cod_ativacao) 
        VALUES ('$nome', '$email', '$hash', '$newcadastro', 'cnpj', '$eoq', '2')";
        $resultInsert = executarSQL($conexao, $sql);

        if ($resultInsert) {
            $_SESSION['mensagem'] = [
                0 => 'Usuário cadastrado com sucesso!',
                1 => '#558b2f light-green darken-3'
            ];
            header('location: ../index.php');
            exit();
        } else {
            $_SESSION['mensagem'] = [
                0 => 'Não foi possível cadastrar o usuário',
                1 => '#c62828 red darken-3'
            ];
            header('location: formcaduser.php');
            exit();
        }
    } catch (Exception $e) {
        echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
    }
} elseif ($eoq == 2) {
    $sql = "INSERT INTO usuarios (nome, email, senha, cadastro, tipo_cadastro, tipo_usuario, cod_ativacao) 
    VALUES ('$nome', '$email', '$hash','$newcadastro', 'cpf', '$eoq', '1')";
    $resultInsert = executarSQL($conexao, $sql);

    if ($resultInsert) {
        $_SESSION['mensagem'] = [
            0 => 'Usuário cadastrado com sucesso!',
            1 => '#558b2f light-green darken-3'
        ];
        header('location: ../index.php');
        exit();
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possível cadastrar o usuário',
            1 => '#c62828 red darken-3'
        ];
        header('location: formcaduser.php');
        exit();
    }
}
