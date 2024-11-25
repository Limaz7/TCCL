<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;
?>


<ul id="slide-out" style="background-color: black;" class="sidenav sidenav-fixed">
    <li <?php if ($paginaCorrente == 'inicioadm.php') {
            echo 'class="active"';
        } ?>><a href="inicioadm.php" class="white-text" style="margin-top: 150px;">Usuários</a></li>
    <li <?php if ($paginaCorrente == 'listareventos.php') {
            echo 'class="active"';
        } ?>> <a class="white-text" href="listareventos.php">Eventos</a></li>
    <li <?php if ($paginaCorrente == 'listaringressos.php') {
            echo 'class="active"';
        } ?>><a class="white-text" href="listaringressos">Ingresso</a></li>
</ul>