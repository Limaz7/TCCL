<?php

session_start();

if ($_SESSION['user'][2] == 3 || $_SESSION['user'][2] == 2 || !isset($_SESSION['user'])) {
    session_destroy();
    header('location: ../telalogin.php');
    die();
}

include('../conexao.php');
$conexao = conectar();

$id = $_GET['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id_usuario= '$id'";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

function formatarDocumento($documento)
{
    $documento = preg_replace('/\D/', '', $documento); // Remove tudo que não for número

    if (strlen($documento) === 11) {
        // CPF: 000.000.000-00
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $documento);
    } elseif (strlen($documento) === 14) {
        // CNPJ: 00.000.000/0000-00
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $documento);
    }

    return $documento; // Retorna sem formatação caso não tenha 11 ou 14 dígitos
}

$cpf_cnpj = formatarDocumento($dados['cadastro']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar usuarios</title>
</head>

<style>
    .buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>

<body>

    <main class="container">

        <div class="card-panel">
            <h1>Editar usuario </h1>
            <form action="../crudUsuario/editUsers.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>"> <br><br>
                Email: <input type="text" name="email" value="<?= $dados['email'] ?>"> <br></br>
                CPF/CNPJ: <input type="text" name="cadastro" value="<?= $cpf_cnpj; ?>"> <br></br>
                Acesso da empresa:
                <div class="input-field col s12">
                    <select name="cod_atv">
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="1" <?= $dados['cod_ativacao'] == '1' ? 'selected' : '' ?>>Validado</option>
                        <option value="2" <?= $dados['cod_ativacao'] == '2' ? 'selected' : '' ?>>Em analise</option>
                        <option value="3" <?= $dados['cod_ativacao'] == '3' ? 'selected' : '' ?>>Negado</option>
                    </select>
                </div>
                <div class="buttons">
                    <a href="listarUsers.php" style="background-color:black; color: white;" class="waves-effect waves-light btn">voltar</a>
                    <button type="submit" style="background-color: green; color:white;" class="waves-effect waves-light btn">Enviar</button>
                </div>
            </form>
        </div>

    </main>

</body>

<script src="../js/materialize.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
</script>

</html>