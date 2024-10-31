<?php

$id_evento = $_POST['id_ev'];
$id_ingresso = $_POST['id_in'];
$qtd = $_POST['qtd'];

session_start();

include('conexao.php');
$conexao = conectar();

$sql = "SELECT quantidade FROM ingressos_cadastrados WHERE id_ingresso= '$id_ingresso'";
$res = executarSQL($conexao, $sql);
$quant = mysqli_fetch_assoc($res);

$token = bin2hex(random_bytes(50));

if ($qtd > $quant['quantidade']) {
    echo "Não existe essa quantidade de ingressos<br>";
    echo "<a href='inicial.php'>Voltar</a>";
    } else {

    $nova_qtd = $quant['quantidade'] - $qtd;

    $sql = "UPDATE ingressos_cadastrados SET quantidade='$nova_qtd'"; 
    executarSQL($conexao, $sql);

    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');

    $sql2 = "INSERT INTO ingressos_comprados
            (id_ingresso, token, id_usuario, quantidade, data, pago) 
            VALUES ('$id_ingresso', '$token', '" . $_SESSION['user'][0] . "', '$qtd', 
            '$agora', 0)";
    executarSQL($conexao, $sql2);

    header('location: inicial.php');
}
