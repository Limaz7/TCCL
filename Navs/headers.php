<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;

if (empty($_SESSION['cart']) || !$_SESSION['cart']) {
    $_SESSION['cart'] = rand(100000, 1000000000);
}

?>


<div class="header-nav">
    <div class="navbar-fixed">
        <nav class="black lighten-3">
            <div class="nav-wrapper">
                <!--<a href="#" class="brand-logo"><img src="imagens/logo01.webp" height="55" width="60"></a>-->

                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    <?php if ($paginaCorrente == 'inicial.php' && !empty($_SESSION['user'])) : ?>

                        <?php if ($dados['tipo_usuario'] == 3) : ?>
                            <li> <a style="background: white; color: black;" class="waves-effect waves-light btn modal-trigger" href="#modalCadastroEvento">Cadastrar evento</a></li>
                        <?php endif; ?>
                        <?php if ($dados['tipo_usuario'] == 2) :

                            $session = $_SESSION['cart'];
                            $carrinho = "SELECT COUNT(*) as total FROM carrinhos WHERE cart_session='$session'";
                            $carrinho = executarSQL($conexao, $carrinho);
                            $row = mysqli_fetch_assoc($carrinho);
                            $count = $row['total'];

                        ?>

                            <li id="counter"><a href="carrinho/cart.php"><i class="material-icons qtd" style="color: white;">shopping_cart</i></a></li>
                        <?php endif; ?>
                        <li> <a class='white-text' href='inicial.php'>Tela inicial</a></li>
                        <li> <a class='white-text' href='Perfil/vizuPerfil.php'> Seu perfil </a> </li>

                        <?php $selectCart = "SELECT * FROM carrinhos WHERE id_usuario=" . $_SESSION['user'][0];
                        $execSelCart = executarSQL($conexao, $selectCart);
                        $resultSelCart = mysqli_fetch_row($execSelCart); ?>

                        <?php if (!isset($resultSelCart)): ?>
                            <li> <a href="logout.php" class="white-text">
                                    <i class="material-icons">power_settings_new</i>
                                </a></li>
                        <?php else: ?>
                            <li> <a href="logout.php" class="btn-floating disabled">
                                    <i class="material-icons">power_settings_new</i>
                                </a></li>
                        <?php endif; ?>

                    <?php elseif (!empty($_SESSION['user'])): ?>

                        <?php if ($paginaCorrente == 'informacoes.php'):

                            $sql_usuario = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
                            $result_usuario = executarSQL($conexao, $sql_usuario);
                            $dados = mysqli_fetch_assoc($result_usuario);

                        ?>
                            <?php if ($dados['tipo_usuario'] == 2) :


                                $session = $_SESSION['cart'];
                                $carrinho = "SELECT COUNT(*) as total FROM carrinhos WHERE cart_session='$session'";
                                $carrinho = executarSQL($conexao, $carrinho);
                                $row = mysqli_fetch_assoc($carrinho);
                                $count = $row['total'];

                            ?>

                                <li id="counter"><a href="carrinho/cart.php"><i class="material-icons qtd" style="color: white;">shopping_cart</i></a></li>
                            <?php endif; ?>
                            <?php if ($dados['tipo_usuario'] == 3) : ?>
                                <li><a style="background: white; color: black;" class="waves-effect waves-light btn modal-trigger" href='#modalCadastroIngresso'>Cadastrar ingressos</a></li>
                            <?php endif; ?>
                            <li> <a class='white-text' href='inicial.php'>Tela inicial</a></li>
                            <li> <a class='white-text' href='Perfil/vizuPerfil.php'> Seu perfil </a> </li>
                            <li> <a href="logout.php" class="white-text">
                                    <i class="material-icons">power_settings_new</i>
                                </a></li>

                        <?php elseif (!empty($_SESSION['user'])): ?>

                            <li> <a class='white-text' href='../inicial.php'>Tela inicial</a></li>
                            <li> <a href="../logout.php" class="white-text">
                                    <i class="material-icons">power_settings_new</i>
                                </a></li>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if (empty($_SESSION['user'])): ?>
                        <li> <a style="background-color: white; color: black;" class='waves-effect waves-light btn' href='index.php'>Login</a></li>
                        <li> <a class='white-text' href='inicial.php'>Tela inicial</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </nav>
    </div>
</div>