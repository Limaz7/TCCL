    <?php

    session_start();

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

    if (isset($_SESSION['user'])) {
        $sql_user = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
        $result1 = executarSQL($conexao, $sql_user);
        $usuario = mysqli_fetch_assoc($result1);
    }


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
            font-size: 6rem;
            top: 25%;
        }

        @media only screen and (max-width: 800px) {
            .info {
                flex-direction: column;
                gap: 20px;
                align-items: end;
            }

            .info .prod {
                margin-inline: 0;
                /* Remove qualquer deslocamento lateral para centralizar no layout */
                right: 0;
            }

            .info .endereco {
                margin: 0;
            }
        }

        .info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-inline: 15vw;
        }

        .icon-endereco,
        .icon-prod,
        .icon-data {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-endereco div,
        .icon-prod div {
            display: flex;
            flex-direction: column;
            max-width: 200px;
        }

        .endereco span,
        .prod span,
        .data span {
            font-style: italic;
            color: grey;
        }

        .icon-data div {
            flex-direction: column;
        }

        .container .cab-desc {
            font-weight: bold;
            font-size: 20px;
            display: block;
            margin-bottom: 10px;
        }

        /* Flex container para as informações do evento */
        .event-info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Descrição do evento */
        .description {
            flex: 1;
            max-width: 60%;
            /* Ajuste para que a descrição ocupe até 60% do espaço */
            margin-right: 20px;
        }

        /* Ingressos */
        .tickets {
            flex: 1;
            max-width: 35%;
            /* Ingressos ocupam até 35% do espaço */
        }

        .tickets a {
            width: 100%;
        }

        /* Responsividade */
        @media only screen and (max-width: 800px) {
            .event-info {
                flex-direction: column;
            }

            .description,
            .tickets {
                max-width: 100%;
            }
        }

        .tickets .card-panel {
            max-width: 300px;
            /* Reduz o tamanho máximo do card */
            padding: 15px;
            /* Diminui o preenchimento dentro do card */
            font-size: 13px;
            /* Diminui o tamanho da fonte */
            margin: 10px;
            /* Dá um espaço entre os cards */
        }

        @media only screen and (max-width: 800px) {
            .tickets .card-panel {
                max-width: 100%;
                /* O card vai ocupar toda a largura da tela em dispositivos menores */
                margin: 10px 0;
                /* Ajusta a margem para que não sobreponha outros elementos */
            }
        }

        .tickets .desc-ing {
            display: block;
            margin-bottom: 10px;
            font-size: 13px;
            font-style: italic;
            color: gray;
        }
    </style>

    <?php include('Navs/headers.php'); ?>

    <body>
        <div class="result"></div>



        <div class="div-text-inic">
            <span class="text-inic"><?= $evento['nome_evento']; ?></span>
        </div><br>

        <div class="info">
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
            <div class="prod">
                <div class="icon-prod">
                    <i class="large material-icons">work</i>
                    <div>
                        <h5 style="margin: auto;">Produtora</h5>
                        <span><?= $evento['produtora']; ?></span>
                    </div>
                </div>
            </div>
            <div class="data">
                <div class="icon-data">
                    <i class="large material-icons">event</i>
                    <div>
                        <h5 style="margin: auto;">Data</h5>
                        <span><?= $evento['data']; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <hr>


        <main class="container">
            <div class="event-info">
                <!-- Descrição do evento -->
                <div class="description">
                    <span class="cab-desc">Descrição do evento</span>
                    <span class="text-desc"><?= nl2br(htmlspecialchars($evento['descricao'])); ?></span>
                </div>

                <?php if (!empty($_SESSION['user'])) : ?>
                    <?php if ($usuario['tipo_usuario'] == 3 && $evento['id_usuario'] == $_SESSION['user'][0]) : ?>

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
                                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                        <button type="submit" class="waves-effect waves-green btn-flat">Cadastrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Ingressos -->
                <div class="tickets">
                    <?php $result = executarSQL($conexao, $sql); ?>
                    <?php while ($ingressos = mysqli_fetch_assoc($result)) : ?>
                        <?php if (isset($ingressos['id_evento'])) : ?>
                            <div class="card-panel #f5f5f5 grey lighten-4">
                                <h5><?= $ingressos['nome_ingresso'] ?></h5>
                                <span>R$ <?= number_format($ingressos['valor'], 2, ',', '.'); ?></span>
                                <span class="desc-ing"><?= $ingressos['desc_ingresso']; ?></span>
                                <input type="hidden" name="id_ingresso" value="<?= $ingressos['id_ingresso']; ?>">
                                <input type="hidden" name="id_evento" value="<?= $ingressos['id_evento']; ?>">

                                <?php if (isset($_SESSION['user'])) : ?>
                                    <?php $select = "SELECT * FROM carrinhos c INNER JOIN carrinho_ingressos_cadastrados cic
                                ON c.id_carrinho = cic.id_carrinho WHERE cic.id_ingresso ='" . $ingressos['id_ingresso'] . "' AND c.id_usuario ='" . $usuario['id_usuario'] . "'";
                                    $execSel = executarSQL($conexao, $select);
                                    $resultSel = mysqli_fetch_row($execSel); ?>
                                <?php endif; ?>


                                <?php if (!isset($resultSel)): ?>

                                    <a style="background: black; color: white;" class="waves-effect waves-light btn buy"
                                        data-value="<?= $ingressos['nome_ingresso']; ?>" data-id="<?= $ingressos['id_evento']; ?>"
                                        data-id-ing="<?= $ingressos['id_ingresso']; ?>">Adicionar ao carrinho</a>

                                <?php else: ?>

                                    <a class="btn disabled">Adicionar ao carrinho</a>

                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <?php if ($ingressos['tipo_pagamento'] == 'Pago'): ?>
                                <style>
                                    .sIng {
                                        color: red;
                                    }
                                </style>
                                <h4 class="sIng">Nenhum ingresso cadastrado</h4>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </main>

        <footer class="black page-footer">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Bora!</h5>
                        <p class="grey-text text-lighten-4">Contato: lazaro.2022315968@aluno.iffar.edu.br</p>
                    </div>
                </div>
            </div>
            <div class=" footer-copyright">
                <div class="container center">
                    © 2025 by Lázaro
                </div>
            </div>
        </footer>
    </body>

    <script src="carrinho/js/jquery.js"></script>
    <script src="carrinho/js/cart.js"></script>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>

    <script>
        var isUserLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false'; ?>;
        var tipoUser = <?= $_SESSION['user'][2]; ?>;
    </script>

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