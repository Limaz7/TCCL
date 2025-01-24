<?php


include('../conexao.php');
$conexao = conectar();

$id = $_GET['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id_usuario= '$id'";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

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
                Codigo para acesso no sistema:
                <p>1 - Acesso liberado</p>
                <p>2 - Em analise</p>
                <p>3 - Acesso negado</p>
                <hr>
                Acesso da empresa:
                <div class="input-field col s12">
                    <select name="cod_atv">
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="1">Validada</option>
                        <option value="2">Em analise</option>
                        <option value="3">Negada</option>
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