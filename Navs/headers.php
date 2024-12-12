<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;

?>



<div class="navbar-fixed">
    <nav class="black lighten-3">
        <div class="nav-wrapper container">
            <!--<a href="#" class="brand-logo"><img src="imagens/logo01.webp" height="55" width="60"></a>-->

            <ul id="nav-mobile" class="right hide-on-med-and-down">
            
                <?php if ($paginaCorrente != 'vizuperfil.php') : ?>
                    <?php if ($paginaCorrente == 'inicial.php') : ?>


                        <?php $sql = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
                        $result = executarSQL($conexao, $sql);
                        $dados = mysqli_fetch_assoc($result);
                        ?>


                        <?php if ($dados['tipo_usuario'] == 3) : ?>
                            <li> <a style="background: white; color: black;" class="waves-effect waves-light btn modal-trigger" href='crudEvento/formcadeventos.php'>Cadastrar evento</a></li>
                        <?php endif; ?>

                    <?php endif; ?>
                    <li> <a class='white-text' href='inicial.php'>Tela inicial</a></li>
                    <li> <a class='white-text' href='Perfil/vizuperfil.php'> Seu perfil </a> </li>
                    <li> <a class='white-text' href='logout.php'>Sair</a></li>
                <?php else: ?>
                    <li> <a class='white-text' href='../inicial.php'>Tela inicial</a></li>
                    <li> <a class='white-text' href='vizuperfil.php'> Seu perfil </a> </li>
                    <li> <a class='white-text' href='../logout.php'>Sair</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</div>