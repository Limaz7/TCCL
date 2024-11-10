<?php

session_start();

if (!isset($_SESSION)) {
    header('location: index.php');
}


include('conexao.php');
$conexao = conectar();

$id = $_GET['id_evento'];

$sql = "SELECT e.*, i.* FROM eventos e 
        LEFT JOIN ingressos_cadastrados i ON e.id_evento= i.id_evento
        WHERE e.id_evento= '$id' ";
$result = executarSQL($conexao, $sql);
$evento = mysqli_fetch_assoc($result);

$sql_user = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result1 = executarSQL($conexao, $sql_user);
$usuario = mysqli_fetch_assoc($result1);

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

<?php include('headers.php'); ?>

<body>
    <main class="container">
        <?php if ($usuario['tipo_usuario'] == 3 and $evento['id_usuario'] == $_SESSION['user'][0]) { ?>
            <br> <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href="crudevento/formediteven?id_evento=<?= $id ?>">EDITAR EVENTO </a> <br> <br>

        <?php } ?>
        <?php if ($usuario['tipo_usuario'] == 3 and $evento['id_usuario'] == $_SESSION['user'][0]) { ?>
            <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href="crudevento/excluireven?id_evento=" <?= $id ?>>EXCLUIR EVENTO </a>
        <?php } ?>

        <h1> <?= $evento['nome_evento']; ?> </h1> <br>
        <?= $evento['descricao']; ?>
        <h5>Local do evento</h5>
        <?= $evento['rua']; ?>, <?= $evento['numero_residencial']; ?> <br>
        <?= $evento['bairro']; ?> <br>
        <h5>Produtora</h5>
        <?= $evento['produtora']; ?>

        <h5>Ingressos</h5>
        <?php if ($usuario['tipo_usuario'] == 2) { ?>

            <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='#modalIngressos'>Comprar ingressos</a>


            <div id="modalIngressos" class="modal">
                <div class="modal-content">
                    <h4>Comprar ingresso</h4>
                    <form action="compraringresso.php" method="post">
                        <input type="hidden" name="id_ev" value="<?= $id ?>">
                        <p>Número do ingresso <input type="text" name="id_in" required>
                        <p>Quantidade <input type="text" name="qtd" required>
                        <div class="modal-footer">
                            <a href="#!" style="background: red;" class="modal-close waves-effect waves-red btn">Cancelar</a>
                            <button style="background: green;" type="submit" class="waves-effect waves-green btn">Comprar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>


        <?php if ($usuario['tipo_usuario'] == 3 and $evento['id_usuario'] == $_SESSION['user'][0]) { ?>
            <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='#modalCadastroIngresso'>Cadastrar ingressos</a> <br> 


            <div id="modalCadastroIngresso" class="modal">
                <div class="modal-content">
                    <h4>Cadastro de ingressos</h4>
                    <form action="cadastroingresso.php" method="post">
                        <input type="hidden" name="id_ev" value="<?= $id ?>">
                        <p>Descrição: <input type="text" name="desc" required></p>
                        <p>Valor: <input type="text" name="valor" required></p>
                        <p>Quantidade: <input type="number" name="qtd" required></p>
                        <div class="modal-footer">
                            <a href="#!" style="background: red;" class="modal-close waves-effect waves-red btn">Cancelar</a>
                            <button style="background: green;" type="submit" class="waves-effect waves-green btn">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>



        <?php $result = executarSQL($conexao, $sql); ?>
        <?php while ($ingressos = mysqli_fetch_assoc($result)) { ?>


            <?php if ($evento['id_ingresso']) { ?>

                <br> Número de série: <?= $ingressos['id_ingresso'] . "<br>"; ?>
                Descrição: <?= $ingressos['descricao'] . "<br>"; ?>
                Valor do ingresso: <?= $ingressos['valor'] . "<br>"; ?>
                Quantidade de ingressos restantes: <?= $ingressos['quantidade'] . "<br>"; ?> <br>

            <?php } ?>


        <?php } ?>

        <h3> Avaliações </h3>

        <a href="#"> UserTeste </a> 10/10 <br>
        Muito bom! <br><br>

        <a href="#"> UserTeste </a> 5/10 <br>
        É... <br><br>

        <a href="#"> UserTeste </a> 0/10 <br>
        Ruim! <br><br>

        <a href="#"> UserTeste </a> 10/10 <br>
        Muito bom! <br><br>

        <a href="#"> UserTeste </a> 10/10 <br>
        Muito bom! <br><br>


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