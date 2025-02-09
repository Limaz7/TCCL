<?PHP

session_start();

if (isset($_SESSION['event'])) {
    unset($_SESSION['event']);
}

include_once "conexao.php";
$conexao = conectar();



$sql = "SELECT * FROM eventos";
$result1 = executarSQL($conexao, $sql);

if (isset($_SESSION['user'])) {
    $sql2 = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
    $result2 = executarSQL($conexao, $sql2);
    $dados = mysqli_fetch_assoc($result2);
}

date_default_timezone_set('America/Sao_Paulo');
$data = new DateTime('now');
$agora = $data->format('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <title>Inicio</title>
</head>

<style>
    .container .row .card {
        box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
        overflow: hidden;
        border-radius: 10px;
    }

    .card-image img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-image {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        overflow: hidden;
    }

    .card-action a {
        width: 100%;
    }

    .card-content span {
        font-style: italic;
        font-size: 12px;
        color: grey;
    }

    .container .text-inic {
        font-size: 30px;
        font-weight: bold;
    }

    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }
</style>

<body>

    <?php include_once "Navs/headers.php"; ?>


    <main class="container">

        <span class="text-inic">Eventos da cidade:</span>

        <div class="row">
            <?php
            $count = 0; // Contador para rastrear os eventos
            while ($evento = mysqli_fetch_assoc($result1)) {
                $_SESSION['evento'][0] = $evento['id_evento'];
                $arq = $evento['imagem'];

                // Se for o primeiro item de uma nova linha, inicia uma nova row
                if ($count % 4 == 0 && $count != 0) {
                    echo '</div><div class="row">';
                }
            ?>
                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-image">
                            <img class="materialboxed" src="imagens/<?= $arq ?>" height="200">
                        </div>
                        <div class="card-content">
                            <p style="font-size: 1vw;"><b><?= $evento['nome_evento']; ?></b></p>
                            <span> <?= $evento['rua']; ?>, <?= $evento['numero_residencial']; ?>, <?= $evento['bairro']; ?> - Entrada:
                                <?= $evento['tipo_pagamento'] ?></span>
                        </div>
                        <div class="card-action">
                            <?php if (empty($_SESSION['user'])) : ?>
                                <?php if ($agora > $evento['data']): ?>
                                    <a class="btn disabled">Mais informações</a>
                                <?php else: ?>
                                <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='informacoes?id_evento=<?= $evento["id_evento"] ?>'>Mais informações</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($agora > $evento['data'] && $dados['tipo_usuario'] == 2): ?>
                                    <a class="btn disabled">Mais informações</a>
                                <?php else: ?>
                                    <a style="background: black; color: white;" class="waves-effect waves-light btn modal-trigger" href='informacoes?id_evento=<?= $evento["id_evento"] ?>'>Mais informações</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
                $count++; // Incrementa contador
            }
            ?>
        </div>

        <!-- Modal Structure -->
        <div id="modalCadastroEvento" class="modal">
            <div class="modal-content">
                <h4>Cadastrar evento</h4>
                <form action="crudevento/cadastroeven.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="nomeEmp" value="<?php echo $_SESSION['user'][1]; ?>">

                    <div class="input-field col s12">
                        <p>Nome do evento: <input type="text" name="nomeEven" required></p>
                    </div>

                    <div class="input-field col s12">
                        <p>Descrição: <textarea id="desc" name="desc" class="materialize-textarea"></textarea></p>
                        </p>
                    </div>

                    <div class="input-field col s12">
                        <p>Rua: <input type="text" name="rua" required></p>
                    </div>

                    <div class="input-field col s12">
                        <p>Número do imóvel: <input type="number" name="numImo" required></p>
                    </div>

                    <div class="input-field col s12">
                        <p>Bairro: <input type="text" name="bairro" required></p>
                    </div>

                    <div class="input-field col s12">
                        <p>Data: <input class="btn-datetime" type="datetime-local" name="data" required></p>
                    </div>

                    <div class="input-field col s12">
                        <p>Tipo de Pagamento:</p>
                        <p><select name="tipoPagamento" required>
                                <option value="" disabled selected>Escolha seu tipo de pagamento</option>
                                <option value="1">Gratuito</option>
                                <option value="2">Pago</option>
                            </select>
                        </p>
                    </div>

                    <div class="input-field col s12">
                        <p>Imagem <input type="file" name="arquivo" required></p>
                    </div>

                    <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                        <button class="waves-effect waves-green btn-flat">Cadastrar</button>
                    </div>
                </form>
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

<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.materialboxed').materialbox(); // Inicializando o materialbox
        $('.modal').modal(); // Inicializando os modais
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
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

</html>