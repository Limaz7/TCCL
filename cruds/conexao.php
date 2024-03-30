<?php

$bdServidor = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdBanco = "tcc";

$conecta = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if(mysqli_connect_errno()) {
    echo "Ocorreu um erro: ";
    echo mysqli_connect_errno();
    die();
}