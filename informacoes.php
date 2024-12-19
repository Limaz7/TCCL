<?php

session_start();

if (!isset($_SESSION['user'])) {
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

$valores_ingressos = []; // Array para armazenar os valores

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
    <!-- <link rel="stylesheet" href="compraIngresso/style.css"> -->

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
</head>

<?php include('Navs/headers.php'); ?>

<body>
    <main class="container">

        <h1> <?= $evento['nome_evento']; ?> </h1> <br>
        <?= $evento['descricao']; ?>
        <h5>Local do evento</h5>
        <?= $evento['rua']; ?>, <?= $evento['numero_residencial']; ?> <br>
        <?= $evento['bairro']; ?> <br>
        <h5>Produtora</h5>
        <?= $evento['produtora']; ?>

        <h5>Ingressos</h5>


        <?php if ($usuario['tipo_usuario'] == 3 and $evento['id_usuario'] == $_SESSION['user'][0]) { ?>
            <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='#modalCadastroIngresso'>Cadastrar ingressos</a> <br>


            <div id="modalCadastroIngresso" class="modal">
                <div class="modal-content">
                    <h4>Cadastro de ingressos</h4>
                    <form action="Ingressos/cadastroingresso.php" method="post">
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


        <h2>Valor dos ingressos: <span id="valor-total">R$ 0,00</span></h2>


        <form action="compraingresso/compraringresso.php" method="post">

            <?php $result = executarSQL($conexao, $sql); ?>
            <?php $i = 0;
            while ($ingressos = mysqli_fetch_assoc($result)) : ?>


                <?php if ($evento['id_ingresso']) { ?>


                    <?php $valores_ingressos[] = $ingressos['valor']; ?> <!-- Adiciona o valor ao array -->

                    <div class="ingresso">
                        <h5><?= $ingressos['informacao'] ?></h5>
                        <p>1º Lote Unissex OPEN BAR R$ <?= number_format($ingressos['valor'], 2, ',', '.'); ?></p>
                        <div class="quantidade">
                            <button type="button" class="decremento" onclick="alterarQuantidade(-1, <?= $i; ?>)">-</button>
                            <span id="qtd-<?= $i; ?>">0</span>
                            <button type="button" class="incremento" onclick="alterarQuantidade(1, <?= $i; ?>)">+</button>
                        </div>
                    </div>




                <?php } ?>

            <?php $i++;
            endwhile; ?>

            <input type="submit" value="Enviar">

        </form>

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


<!-- Passando o array PHP para o JavaScript -->
<script>
    const precos = <?php echo json_encode($valores_ingressos); ?>; // Array com os valores dos ingressos
    console.log(precos); // Debug: Confirmação dos valores no console
</script>


<script src="compraIngresso/script.js"></script>

</html>