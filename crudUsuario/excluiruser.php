<?php

session_start();

include_once "../conexao.php";
$conexao = conectar();

$id = $_GET['id_usuario'];
$pasta = "../imagens/";

$select = "SELECT * FROM usuarios WHERE id_usuario='$id'";
$result = executarSQL($conexao, $select);
$dados = mysqli_fetch_assoc($result);

if ($dados['tipo_usuario'] == 2) {

    $selectCarrinho = "SELECT id_carrinho FROM carrinhos WHERE id_usuario ='$id'";
    $execSelect = executarSQL($conexao, $selectCarrinho);

    $idsCarrinhos = [];
    while ($row = mysqli_fetch_assoc($execSelect)) {
        $idsCarrinhos[] = $row['id_carrinho'];
    }

    if (!empty($idsCarrinhos)) {
        $idsCarrinhosStr = implode(",", $idsCarrinhos);

        $delete_cic = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_carrinho IN ($idsCarrinhosStr)";
        executarSQL($conexao, $delete_cic);

        $delete_inc = "DELETE FROM carrinhos WHERE id_usuario='$id'";
        executarSQL($conexao, $delete_inc);
    }

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    $result_DelUser = executarSQL($conexao, $delete_user);

    if ($result_DelUser) {
        $_SESSION['mensagem'][0] = "Usuário excluido com sucesso!";
        $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
    } else {
        $_SESSION['mensagem'][0] = "Não foi possível excluir o usuário!";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
    }
} elseif ($dados['tipo_usuario'] == 3) {

    $selectCIC = "SELECT * FROM ingressos_cadastrados ica
    INNER JOIN eventos e 
    ON ica.id_evento = e.id_evento WHERE e.id_usuario='$id'";
    $execSel = executarSQL($conexao, $selectCIC);

    $idsIngressos = [];
    while ($result = mysqli_fetch_assoc($execSel)) {
        $idsIngressos[] = $result['id_ingresso'];
    }

    if (!empty($idsIngressos)) {
        $idsIngressosStr = implode(",", $idsIngressos);

        $deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_ingresso IN ($idsIngressosStr)";
        executarSQL($conexao, $deleteCIC);

        $delete_incads = "DELETE FROM ingressos_cadastrados WHERE id_ingresso IN ($idsIngressosStr)";
        executarSQL($conexao, $delete_incads);
    }

    $selectEventos = "SELECT imagem FROM eventos WHERE id_usuario='$id'";
    $execEventos = executarSQL($conexao, $selectEventos);

    while ($img = mysqli_fetch_assoc($execEventos)) {
        $caminhoImagem = $pasta . $img['imagem'];
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    $delete_eve = "DELETE FROM eventos WHERE id_usuario='$id'";
    executarSQL($conexao, $delete_eve);

    $delete_user = "DELETE FROM usuarios WHERE id_usuario='$id'";
    $resultDelUser = executarSQL($conexao, $delete_user);

    if ($resultDelUser) {
        $_SESSION['mensagem'][0] = "Usuário excluido com sucesso!";
        $_SESSION['mensagem'][1] = "#558b2f light-green darken-3";
    } else {
        $_SESSION['mensagem'][0] = "Não foi possível excluir o usuario!";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
    }
}

header('location: ../telasAdmin/listarUsers.php');
exit();
