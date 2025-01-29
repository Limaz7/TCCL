<?php

session_start();

if ($_SESSION['user'][2] == 3 || $_SESSION['user'][2] == 2 || !isset($_SESSION['user'])) {
    session_destroy();
    header('location: ../telalogin.php');
    die();
}

include('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
$result = executarSQL($conexao, $sql);

function formatarDocumento($documento)
{
    $documento = preg_replace("/\D/", "", $documento); // Remove tudo que não for número

    if (strlen($documento) === 11) { // CPF (XXX.XXX.XXX-XX)
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $documento);
    } elseif (strlen($documento) === 14) { // CNPJ (XX.XXX.XXX/XXXX-XX)
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $documento);
    }

    return $documento; // Retorna sem alterações se não for CPF nem CNPJ
}

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
    <title>Document</title>
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF/CNPJ</th>
                    <th>Validação de entrada</th>
                    <th>Tipo de usuário</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($result as $results) : ?>
                        <?php if ($results['id_usuario'] > 1) : ?>
                            <td><?= $results['id_usuario']; ?></td>
                            <td><?= $results['nome']; ?></td>
                            <td><?= $results['email']; ?></td>
                            <td><?= formatarDocumento($results['cadastro']); ?></td>
                            <td><?= $results['cod_ativacao']; ?></td>
                            <td><?= $results['tipo_usuario']; ?> </td>
                            <td><a href="formedituser?id_usuario=<?= $results['id_usuario']; ?>">Editar</a></td>
                            <td><a href="#modalExcluirUser<?= $results['id_usuario']; ?>" class="modal-trigger">Excluir</a></td>
                        <?php endif; ?>
                </tr>

                <div id="modalExcluirUser<?= $results['id_usuario']; ?>" class="modal">
                    <div class="modal-content">
                        <h4>Confirmar exclusão</h4>
                        <p>Você tem certeza que deseja excluir esse usuário?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                        <a href="../crudUsuario/excluiruser?id_usuario=<?= $results['id_usuario']; ?>" class="modal-close waves-effect waves-green btn-flat">Confirmar</a>
                    </div>
                </div>

            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <p>Tipo de usuário:</p>
        <p>2 - Participante</p>
        <p>3 - Empresa</p>

    </main>


</body>

<!-- Import jQuery antes do materialize.min.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Agora, importe o materialize.min.js -->
<script type="text/javascript" src="../js/materialize.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });


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