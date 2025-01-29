<?php
if ($tipoUser == 1) {
    $tipoUser = $_GET['tipo_usuario'];

    $selectCarrinho = "SELECT COUNT(*) AS total_comprado FROM carrinho_ingressos_cadastrados WHERE id_ingresso = '$id'";
    $execCarrinho = executarSQL($conexao, $selectCarrinho);
    $rowCarrinho = mysqli_fetch_assoc($execCarrinho);

    $totalComprado = $rowCarrinho['total_comprado'];

    if ($totalComprado > 0) {
        $deleteCIC = "DELETE FROM carrinho_ingressos_cadastrados WHERE id_ingresso = '$id'";
        executarSQL($conexao, $deleteCIC);
    }

    $deleteCart = "DELETE c FROM carrinhos c INNER JOIN carrinho_ingressos_cadastrados cic WHERE cic.id_ingresso= '$id'";
    executarSQL($conexao, $deleteCart);

    $deleteIngressos = "DELETE FROM ingressos_cadastrados WHERE id_ingresso = '$id'";
    $resultDelIngresso = executarSQL($conexao, $deleteIngressos);

    if ($resultDelIngresso) {
        $_SESSION['mensagem'][0] = 'Ingresso excluído com sucesso!';
        $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';
    } else {
        $_SESSION['mensagem'][0] = 'Não foi possível excluir o ingresso.';
        $_SESSION['mensagem'][1] = '#c62828 red darken-3';
    }

    header('location: ../telasadmin/vizuIngressos.php');
}