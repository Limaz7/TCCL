<?php

include "../conexao.php";
$conexao = conectar();

session_start();

$sql1 = "SELECT * FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql1);
$evn = mysqli_fetch_assoc($result);

$selectUser = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$execSelUser = executarSQL($conexao, $selectUser);
$resultSelUser = mysqli_fetch_assoc($execSelUser);

$pastaImg = "../imagens/";

if ($resultSelUser['tipo_usuario'] == 2) {

    $selectCarrinho = "SELECT id_carrinho FROM carrinhos WHERE id_usuario =" . $_SESSION['user'][0];
    $execSelect = executarSQL($conexao, $selectCarrinho);

    while ($resultSelCart = mysqli_fetch_assoc($execSelect)) {
        $idCart = $resultSelCart['id_carrinho'];

        $delete_cic = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_carrinho='$idCart'";
        $execDelCIC = executarSQL($conexao, $delete_cic);
    }

    $selectIngComp = "SELECT * FROM carrinhos WHERE id_usuario=" . $_SESSION['user'][0];
    $execSelIngComp = executarSQL($conexao, $selectIngComp);
    $rowsSelIngComp = mysqli_num_rows($execSelIngComp);

    if ($rowsSelIngComp > 0) {
        $deleteIngComp = "DELETE FROM carrinhos WHERE id_usuario = " . $_SESSION['user'][0];
        $execDelIngComp = executarSQL($conexao, $deleteIngComp);
    } else {
        $execDelIngComp = true;
    }

    $deleteUser = "DELETE FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
    $execDelUser = executarSQL($conexao, $deleteUser);

    if ($execDelIngComp && $execDelUser && $execDelCIC) {
        $_SESSION['mensagem'] = [
            0 => 'Usuário excluido com sucesso!',
            1 => '#558b2f light-green darken-3'
        ];
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possivel excluir o usuario!',
            1 => '#c62828 red darken-3'
        ];
    }
} elseif ($resultSelUser['tipo_usuario'] == 3) {

    $selectIngComp = "SELECT * FROM carrinho_ingressos_cadastrados cic INNER JOIN 
    ingressos_cadastrados ica
    ON ica.id_ingresso = cic.id_ingresso 
    INNER JOIN eventos e
    ON e.id_evento = ica.id_evento
    WHERE e.id_usuario=" . $_SESSION['user'][0];
    $execSelIngComp = executarSQL($conexao, $selectIngComp);
    $rowsSelIngComp = mysqli_num_rows($execSelIngComp);

    if($rowsSelIngComp > 0){
        $_SESSION['mensagem'] = [
            0 => 'Você não pode excluir seu perfil porque há ingressos comprados nos seus eventos',
            1 => '#c62828 red darken-3'
        ];
        header('location: vizuperfil.php');
        die();
    }

    $selectIngCad = "SELECT ica.* FROM ingressos_cadastrados ica
                     INNER JOIN eventos e 
                     ON ica.id_evento = e.id_evento 
                     WHERE e.id_usuario=" . $_SESSION['user'][0];
    $execSelIngCad = executarSQL($conexao, $selectIngCad);
    $rowsSelIngCad = mysqli_num_rows($execSelIngCad);

    if ($rowsSelIngCad > 0) {
        $deleteIngCad = "DELETE ica FROM ingressos_cadastrados ica
                         INNER JOIN eventos e 
                         ON ica.id_evento = e.id_evento
                         WHERE e.id_usuario=" . $_SESSION['user'][0];

        $execDelIngCad = executarSQL($conexao, $deleteIngCad);
    } else {
        $execDelIngCad = true;
    }

    $selectEvn = "SELECT * FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
    $execSelEvn = executarSQL($conexao, $selectEvn);
    $rowsSelEvn = mysqli_num_rows($execSelEvn);

    if ($rowsSelEvn > 0) {
        unlink($pastaImg . $evn['imagem']);
        $deleteEvn = "DELETE FROM eventos WHERE id_usuario=" . $_SESSION['user'][0];
        $execDelEvn = executarSQL($conexao, $deleteEvn);
    } else {
        $execDelEvn = true;
    }

    $deleteUser = "DELETE FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
    $execDeluser = executarSQL($conexao, $deleteUser);

    if ($execDelEvn && $execDelIngCad && $execDeluser) {
        $_SESSION['mensagem'] = [
            0 => 'Usuário excluido com sucesso!',
            1 => '#558b2f light-green darken-3'
        ];
    } else {
        $_SESSION['mensagem'] = [
            0 => 'Não foi possível excluir o usuario!',
            1 => '#c62828 red darken-3'
        ];
    }
}


session_destroy();
header('location: ../index.php');
