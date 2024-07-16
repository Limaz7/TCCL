<?php

$pasta = "./imagens/";

$nomeArquivo = $_FILES['arquivo']['name'];

if(file_exists(__DIR__ . $pasta . $nomeArquivo)){
    echo "O arquivo ja existe";
    die();
}

?>