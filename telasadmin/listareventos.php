<?php

session_start();

include("../conexao.php");
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>listareventos</title>
</head>

<style>
    /* Estilo para o item ativo da sidenav */
    .sidenav .active {
        background-color: white !important;
        /* Cor de fundo para o item ativo (rosa) */
        color: black !important;
        /* Cor do texto do item ativo */
    }

    /* Estilo adicional para links quando ativos */
    .sidenav li.active a {
        color: black !important;
        /* Garantir que o texto seja branco */
    }
</style>


<body>

    <?php include("../Navs/sidenav.php"); ?>

    <main class="container" style="margin-top: 100px; margin-left: 400px;">

        <table class="striped" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem do evento</th>
                    <th>Nome do evento</th>
                    <th>Produtora</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Numero residencial</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($result): 
                foreach ($result as $results) :
                    $arq = $results['imagem']; ?>

                    <tr>
                        <td><?= $results['id_evento'] ?></td>
                        <td><img src="../imagens/<?= $arq ?>" height="55"></td>
                        <td><?= $results['nome_evento'] ?></td>
                        <td><?= $results['produtora'] ?></td>
                        <td><?= $results['descricao'] ?></td>
                        <td><?= $results['data'] ?></td>
                        <td><?= $results['cep'] ?></td>
                        <td><?= $results['rua'] ?></td>
                        <td><?= $results['bairro'] ?></td>
                        <td><?= $results['numero_residencial'] ?></td>
                        <td><a href="../crudEvento/formediteven?id_evento=<?= $results['id_evento']; ?>">Editar</a></td>
                        <td><a href="../crudEvento/excluireven?id_evento=<?= $results['id_evento']; ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <td>Nenhum evento cadastrado</td>
                <?php endif; ?>
            </tbody>

        </table>

    </main>
</body>

<!-- Import jQuery antes do materialize.min.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Agora, importe o materialize.min.js -->
<script type="text/javascript" src="../js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });

    <?php if (isset($_SESSION['mensagem'])): ?>
        M.toast({
            html: '<?= $_SESSION['mensagem'][0] ?>',
            classes: '<?= $_SESSION['mensagem'][1] ?>'
        });

    <?php unset($_SESSION['mensagem']);
    endif; ?>
</script>

</html>