<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;
?>



<div class="navbar-fixed">
    <nav class="black lighten-3">
        <div class="nav-wrapper container">
            <!--<a href="#" class="brand-logo"><img src="imagens/logo01.webp" height="55" width="60"></a>-->

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php if ($paginaCorrente != 'vizuperfil.php') {
                    echo "<li> <a class='white-text' href='inicial.php'>Tela inicial</a></li>";
                    echo "<li> <a class='white-text' href='crudperfil/vizuperfil.php'> Seu perfil </a> </li>";
                    echo "<li> <a class='white-text' href='logout.php'>Sair</a></li>";
                } else {
                    echo "<li> <a class='white-text' href='../inicial.php'>Tela inicial</a></li>";
                    echo "<li> <a class='white-text' href='logout.php'>Sair</a></li>";
                } ?>
            </ul>
        </div>
    </nav>
</div>