<?php
include('conexao.php');
$conexao = conectar();

$id = $_GET['id_evento'];

$sql = "SELECT e.*, i.* FROM eventos e 
        LEFT JOIN ingressos_cadastrados i ON e.id_evento= i.id_evento
        WHERE e.id_evento= '$id'";
$result = executarSQL($conexao, $sql);
$evento = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
</head>

<body>
    <main class="container">
        <?= $evento['nome_evento']; ?> <br>
        <h5>Local do evento</h5>
        <?= $evento['rua']; ?>, <?= $evento['cep']; ?> <br>
        <?= $evento['bairro']; ?> <br>
        <h5>Produtora</h5>
        <?= $evento['nome_empresa']; ?>

        <h5>Ingresso</h5>
        <?= $evento['descricao']; ?>
        <?= $evento['valor']; ?>
        <?= $evento['quantidade']; ?>
        <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='#modal<?= $evento["id_evento"] ?>'>Cadastrar ingressos</a>
        <div id="modal<?= $evento['id_evento']; ?>" class="modal">
            <div class="modal-content">
                <h4>Cadastro de ingressos</h4>
                <form action="cadastroingresso.php" method="post">
                    <input type="hidden" name="id_ev" value="<?= $id ?>">
                    <p>Descrição: <input type="text" name="desc" required></p>
                    <p>Valor: <input type="number" name="valor" required></p>
                    <p>Quantidade: <input type="number" name="qtd" required></p>
                    <div class="modal-footer">
                        <a href="#!" style="background: red;" class="modal-close waves-effect waves-red btn">Cancelar</a>
                        <button style="background: green;" type="submit" class="waves-effect waves-green btn">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/materialize.min.js"></script>
<script>
    $(document).ready(function() {
        $('.materialboxed').materialbox(); // Inicializando o materialbox
        $('.modal').modal(); // Inicializando os modais
    });
</script>


</html>