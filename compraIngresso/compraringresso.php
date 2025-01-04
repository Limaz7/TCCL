<?php

/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../rec-senha/PHPMailer/src/Exception.php';
require '../rec-senha/PHPMailer/src/PHPMailer.php';
require '../rec-senha/PHPMailer/src/SMTP.php'; */

session_start();

$id_evento = $_POST['id_evento'];
$id_user = $_POST['id_usuario'];
$id_ingresso = $_POST['id_ingresso'];
$qtd = $_POST['qtd'];

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT quantidade FROM ingressos_cadastrados WHERE id_ingresso= '$id_ingresso'";
$res = executarSQL($conexao, $sql);
$quant = mysqli_fetch_assoc($res);

$token = bin2hex(random_bytes(50));

if ($qtd > $quant['quantidade']) {
    header ("location: ../informacoes?id_evento=$id_evento&maior=1");
} else {

    $nova_qtd = $quant['quantidade'] - $qtd;

    $sql = "UPDATE ingressos_cadastrados SET quantidade='$nova_qtd' WHERE id_ingresso=$id_ingresso";
    executarSQL($conexao, $sql);

    $sql = "SELECT * FROM usuarios WHERE id_usuario='$id_user'";
    $resultado = executarSQL($conexao, $sql);

    $usuario = mysqli_fetch_assoc($resultado);
    if ($usuario == null) {
        echo "Email não cadastrado! Faça o cadastro e 
          em seguida realize o login.";
        echo "<a href='informacoes?id_evento=$id_evento'>Voltar</a>";
        die();
    }

    /* include "../config.php";

    // Instância da classe
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('br');
        $mail->isSMTP();        //Devine o uso de SMTP no envio
        $mail->SMTPAuth = true; //Habilita a autenticação SMTP
        $mail->Username   = $config['email'];
        $mail->Password   = $config['senha_email'];
        // Criptografia do envio SSL também é aceito
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // Informações específicadas pelo Google
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // Define o remetente
        $mail->setFrom($config['email'], 'Não responda!');
        // Define o destinatário
        $mail->addAddress($usuario['email'], $usuario['nome']);
        $mail->addReplyTo($config['email'], 'Sistema de gerenciamento de eventos culturais');
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Confirmação da compra do ingresso';
        $mail->Body    = 'Este é o corpo da mensagem <b>Olá!</b> <br><br>
        <img src="cid:imagem_cid">'; //Pega a imagem do CID

        //Pega a imagem e colocar um ID nela
        $mail->addEmbeddedImage('../imagens/6711658d195c6.png', 'imagem_cid');
        // Enviar
        $mail->send();
        echo "A mensagem foi enviada! Verifique seu email. <br><br> <a href='../informacoes.php?id_evento=$id_evento'>Voltar</a>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } */

    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');

    $sql2 = "INSERT INTO ingressos_comprados
            (id_ingresso, ticket, id_usuario, quantidade, data, pago) 
            VALUES ('$id_ingresso', '$token', '$id_user', '$qtd', 
            '$agora', 0)";
    executarSQL($conexao, $sql2);

    header("location: ../informacoes?id_evento=$id_evento&sucesso=1");
}
