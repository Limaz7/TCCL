<?php

include("../conexao.php");
$conexao = conectar();

$id_ev = $_POST['id_ev'];
$nome = $_POST['nome'];
$desc = $_POST['desc'];
$valor = $_POST['valor'];
$qtd = $_POST['qtd'];

$sql = "INSERT INTO ingressos_cadastrados(id_evento, nome_ingresso, desc_ingresso, valor, estoque)
        VALUES ('$id_ev', '$nome', '$desc', $valor, '$qtd')";

$resultIngressoCad = executarSQL($conexao, $sql);

session_start();

if ($resultIngressoCad) {
        $_SESSION['mensagem'] = [
                0 => "Ingresso cadastrado com sucesso!",
                1 => "#558b2f light-green darken-3"
        ];
} else {
        $_SESSION['mensagem'] = [
                0 =>  "Não foi possível cadastrar o ingresso",
                1 =>  "#c62828 red darken-3"
        ];
}
header("location: ../informacoes.php?id_evento=$id_ev");
exit();
