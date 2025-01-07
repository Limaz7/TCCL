    <?php

    session_start();

    if (!isset($_SESSION['user'])) {
        header('location: index.php');
    }

    if (isset($_SESSION['event'])) {
        unset($_SESSION['event']);
    }

    include('conexao.php');
    $conexao = conectar();

    $id = $_GET['id_evento'];

    $sql = "SELECT e.*, i.* FROM eventos e 
            LEFT JOIN ingressos_cadastrados i ON e.id_evento= i.id_evento
            WHERE e.id_evento= '$id'";
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
        <!-- <link rel="stylesheet" href="compraIngresso/style.css"> -->
        <link type="text/css" rel="stylesheet" href="carrinho/css/cart.css" />
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
    </head>

    <?php include('Navs/headers.php'); ?>

    <body>
        <div class="result"></div>

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



            <?php $result = executarSQL($conexao, $sql); ?>
            <?php while ($ingressos = mysqli_fetch_assoc($result)) : ?>


                <?php if ($ingressos['id_ingresso']) : ?>


                    <div class="card-panel #f5f5f5 grey lighten-4" style="max-width: 400px;">
                        <h5><?= $ingressos['nome_ingresso'] ?></h5>
                        <p><?= $ingressos['desc_ingresso']; ?></p>
                        <p>
                        <h4> R$ <?= number_format($ingressos['valor'], 2, ',', '.'); ?></h4>
                        </p>
                        <input type="hidden" name="id_ingresso" value="<?= $ingressos['id_ingresso']; ?>">
                        <input type="hidden" name="id_evento" value="<?= $ingressos['id_evento']; ?>">
                        <a style="background: black; color: white;" class="waves-effect waves-light btn buy"
                            data-value="<?= $ingressos['nome_ingresso']; ?>" data-id="<?= $ingressos['id_evento']; ?>">Adicionar ao carrinho</a>
                    </div>


                <?php endif; ?>

                <!-- <div id="modalComprarIngresso" class="modal">
                    <div class="modal-content">
                        <h4>Compre seu ingresso</h4>
                        <form action="compraIngresso/compraringresso.php" method="post">
                            <input type="hidden" name="id_evento" value="">
                            <input type="hidden" name="id_ingresso" value="">
                            <input type="hidden" name="id_usuario" value="">

                            <p>Quantidade: <input type="number" name="qtd" required></p>
                            <div class="modal-footer">
                                <a href="#!" style="background: red;" class="modal-close waves-effect waves-red btn">Cancelar</a>
                                <button style="background: green;" type="submit" class="waves-effect waves-green btn">Comprar</button>
                            </div>
                        </form>
                    </div>
                </div> -->


            <?php endwhile; ?>


        </main>
    </body>

    <script src="carrinho/js/jquery.js"></script>
    <script src="carrinho/js/cart.js"></script>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>

    <?php
    include("functionMensagens.php");

    if (isset($_SESSION['mensagem'])) {
        exibirMensagem($_SESSION['mensagem'][0], $_SESSION['mensagem'][1]);
        unset($_SESSION['mensagem']);

        var_dump($_SESSION['mensagem']);
    }
    ?>

    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox(); // Inicializando o materialbox
            $('.modal').modal(); // Inicializando os modais
        });
    </script>

    </html>