<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
//echo $pagina_corrente;
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<ul id="slide-out" style="background-color: black;" class="sidenav sidenav-fixed">
    <li <?php if ($paginaCorrente == 'listarUsers.php') {
            echo 'class="active"';
        } ?>><a href="../telasAdmin/listarUsers.php" class="white-text" style="margin-top: 150px;">Usuários</a></li>
    <li <?php if ($paginaCorrente == 'listareventos.php') {
            echo 'class="active"';
        } ?>> <a class="white-text" href="../telasAdmin/listareventos.php">Eventos</a></li>
    <li <?php if ($paginaCorrente == 'vizuIngressos.php') {
            echo 'class="active"';
        } ?>><a class="white-text" href="../crudIngresso/vizuIngressos.php">Ingresso</a></li>
    <li <?php if ($paginaCorrente == 'vizuPedidos.php') {
            echo 'class="active"';
        } ?>><a class="white-text" href="../crudIngresso/vizuPedidos.php">Pedidos</a></li>
    <li style="margin-top: auto; display: flex; justify-content: center; align-items: center;">
        <div>
            <a href="../logout.php" class="white-text">
                <i class="material-icons" style="margin-top: 61vh;">power_settings_new</i>
            </a>
        </div>
    </li>
</ul>