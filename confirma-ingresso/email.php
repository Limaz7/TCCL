<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../rec-senha/PHPMailer/src/Exception.php';
require '../rec-senha/PHPMailer/src/PHPMailer.php';
require '../rec-senha/PHPMailer/src/SMTP.php';

require_once "../conexao.php";
$conexao = conectar();

$email = $_POST['email'];
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);
if ($usuario == null) {
    echo "Email não cadastrado! Faça o cadastro e 
          em seguida realize o login.";
    echo "<a href='form_rec_senha.php'>Voltar</a>";
    die();
}

// Instância da classe
$mail = new PHPMailer(true);
try
{
    // Configurações do servidor
    $mail->isSMTP();        //Devine o uso de SMTP no envio
    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
    $mail->Username   = $config['username'];
    $mail->Password   = $config['password'];
    // Criptografia do envio SSL também é aceito
    $mail->SMTPSecure = 'tls';
    // Informações específicadas pelo Google
    $mail->Host = 'smtp.email.com';
    $mail->Port = 587;
    // Define o remetente
    $mail->setFrom($config['email'], 'Não responda!');
    // Define o destinatário
    $mail->addAddress($usuario['email'], $usuario['nome']);
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Teste Envio de Email';
    $mail->Body    = 'Este é o corpo da mensagem <b>Olá!</b>';
    // Enviar
    $mail->send();
    echo 'A mensagem foi enviada!';
}
catch (Exception $e)
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>




