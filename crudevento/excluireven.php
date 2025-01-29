<?php

session_start();

$id = $_GET['id_evento'];

include "../conexao.php";
$conexao = conectar();

$pastaImg = "../imagens/";

$tipoUser = $_GET['tipo_usuario'];

if ($tipoUser == 1) {

    $selectCIC = "SELECT id_ingresso FROM ingressos_cadastrados WHERE id_evento='$id'";
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

    $selectEventos = "SELECT imagem FROM eventos WHERE id_evento='$id'";
    $execEventos = executarSQL($conexao, $selectEventos);

    while ($img = mysqli_fetch_assoc($execEventos)) {
        $caminhoImagem = $pastaImg . $img['imagem'];
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    // 4️⃣ EXCLUIR O EVENTO
    $delete_eve = "DELETE FROM eventos WHERE id_evento='$id'";
    $resultDelEven = executarSQL($conexao, $delete_eve);

    // ✅ FEEDBACK PARA O USUÁRIO
    if ($resultDelEven) {
        $_SESSION['mensagem'][0] = 'Evento excluído com sucesso!';
        $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';
    } else {
        $_SESSION['mensagem'][0] = "Não foi possível excluir o evento.";
        $_SESSION['mensagem'][1] = "#c62828 red darken-3";
    }

    if ($conexao->error) {
        die("Erro: " . $conexao->error);
    }
}

$selectIngCad = "SELECT * FROM ingressos_cadastrados  ica
INNER JOIN eventos e
ON e.id_evento = ica.id_evento 
WHERE e.id_evento=$id";
$execSelIngCad = executarSQL($conexao, $selectIngCad);
$resultSelIngCad = mysqli_fetch_assoc($execSelIngCad);

$idIngCad = $resultSelIngCad['id_ingresso'];

$selectCIC = "SELECT * FROM carrinho_ingressos_cadastrados cic 
INNER JOIN ingressos_cadastrados ica 
ON cic.id_ingresso = ica.id_ingresso
INNER JOIN eventos e 
ON e.id_evento = ica.id_evento
WHERE cic.id_ingresso='$idIngCad'";
$execSelCIC = executarSQL($conexao, $selectCIC);
$row = mysqli_fetch_row($execSelCIC);

if ($row > 0) {
    $_SESSION['mensagem'] = [
        0 => 'Você não pode excluir esse evento, porque alguem já comprou o ingresso dele.',
        1 => '#c62828 red darken-3'
    ];
    header('location: ../Perfil/vizuEventosCad.php');
    die();
}

$sql1 = "SELECT e.imagem FROM eventos e WHERE id_evento = '$id'";
$result = executarSQL($conexao, $sql1);
$img = mysqli_fetch_assoc($result);

unlink($pastaImg . $img['imagem']);

$sql_ingresso = "DELETE FROM ingressos_cadastrados WHERE id_evento = '$id'";
$resultDelIng = executarSQL($conexao, $sql_ingresso);

$sql_even = "DELETE FROM eventos WHERE id_evento = '$id'";
$resultDelEven = executarSQL($conexao, $sql_even);

if ($resultDelEven && $resultDelIng) {
    $_SESSION['mensagem'][0] = 'Evento excluido com sucesso!';
    $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';
} else {
    $_SESSION['mensagem'][0] = "Não foi possivel editar o evento.";
    $_SESSION['mensagem'][1] = "#c62828 red darken-3";
}

if ($_SESSION['user'][2] == 3) {
    header('location: ../Perfil/vizuEventosCad.php');
    exit();
} elseif ($_SESSION['user'][2] == 1) {
    header('location: ../telasAdmin/listareventos.php');
    exit();
}

if ($conexao->error) {
    die("Erro" . $conexao->error);
}
