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

    <style>
        @font-face {
            font-family: 'MinhaFonte';
            src: url('fontes/SLICKYBOHEM-Regular.otf') format('opentype');
        }

        .div-text-inic {
            background: linear-gradient(to right, rgb(0, 0, 0) 20%, #212121 100%);
            width: 100%;
            height: 12vw;
            background-color: green;
            font-family: 'MinhaFonte';
        }

        .text-inic {
            position: relative;
            margin-inline-start: 17%;
            color: white;
            font-size: 6vw;
            top: 25%;
        }

        @media only screen and (min-width: 601px) {
            .container {
                width: 85%;
            }
        }

        @media only screen and (min-width: 993px) {
            .container {
                width: 70%;
            }
        }

        .endereco {
            margin-inline: 15vw;
        }

        .icon-endereco {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-endereco div {
            display: flex;
            flex-direction: column;
        }

        .endereco span {
            font-style: italic;
            color: grey;
        }
    </style>

    <?php include('Navs/headers.php'); ?>

    <body>
        <div class="result"></div>



        <div class="div-text-inic">
            <span class="text-inic"><?= $evento['nome_evento']; ?></span>
        </div><br>
        <div class="endereco">
            <div class="icon-endereco">
                <i class="large material-icons">room</i>
                <div>
                    <h5 style="margin: auto;">Local do evento</h5>
                    <span><?= $evento['rua']; ?>, <?= $evento['numero_residencial']; ?></span>
                    <span><?= $evento['bairro']; ?></span>
                </div>
            </div>
        </div>
        <hr>
        <span><?= $evento['descricao']; ?></span>
        <span>Produtora</span> <br>
        <span><?= $evento['produtora']; ?></span>

        <main class="container">

            <?php if ($usuario['tipo_usuario'] == 3 and $evento['id_usuario'] == $_SESSION['user'][0]) { ?>


                <div id="modalCadastroIngresso" class="modal">
                    <div class="modal-content">
                        <h4>Cadastro de ingressos</h4>
                        <form action="crudIngresso/cadastroingresso.php" method="post">
                            <input type="hidden" name="id_ev" value="<?= $id ?>">
                            <p>Nome do ingresso: <input type="text" name="nome" required></p>
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


                <?php if ($usuario['tipo_usuario'] == 2) : ?>
                    <?php if (isset($ingressos['id_evento'])) : ?>


                        <?php if ($ingressos['status'] == 1): ?>
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

                    <?php else:
                        echo "<style>h4{color: red;}</style><h4>Nenhum ingresso cadastrado</h4>";
                    endif; ?>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.toast({
                html: <?php echo json_encode($mensagem); ?>,
                classes: '<?php echo $cor; ?>'
            });
        });
    </script>

    <script>
        <?php if (isset($_SESSION['mensagem'])): ?>
            M.toast({
                html: '<?= $_SESSION['mensagem'][0] ?>',
                classes: '<?= $_SESSION['mensagem'][1] ?>'
            });

        <?php unset($_SESSION['mensagem']);
        endif; ?>
    </script>

    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox(); // Inicializando o materialbox
            $('.modal').modal(); // Inicializando os modais
        });
    </script>

    </html>