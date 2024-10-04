<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;
?>



<div class="navbar-fixed">
    <nav class="black lighten-3">
        <div class="nav-wrapper container">
            <!--<a href="#" class="brand-logo"><img src="imagens/logo01.webp" height="55" width="60"></a>-->

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li <?php if ($paginaCorrente == 'iniempresa.php') {
                        echo 'class="active"';
                    } ?>> <a class="white-text" href="iniempresa.php">Home</a></li>
                <li <?php if ($paginaCorrente == 'crudperfil/vizuperfil.php') {
                        echo 'class="active"';
                    } ?>> <a class="white-text" href="crudperfil/vizuperfil.php"> Vizualizar perfil </a></li>
                <li <?php if ($paginaCorrente == 'sair.php') {
                        echo 'class="active"';
                    } ?>> <a class="white-text" href="index.php">Sair</a></li>
            </ul>
        </div>
    </nav>
</div>