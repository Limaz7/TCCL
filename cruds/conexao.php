<?php

function conectar()
{

    require_once "config.php";

    $mysqli = mysqli_connect(

        $config['host'],
        $config['user'], 
        $config['pass'], 
        $config['bd'],
    
    );

    if ($mysqli === false) {

        echo "Erro ao conectar com o banco de dados. N° do erro:" .
            mysqli_connect_errno() . " " . 
            mysqli_connect_error();
        die();
    }

    return $mysqli;
}

function executarSQL($mysqli, $sql)
{

    $resultado = mysqli_query($mysqli, $sql);

    if ($resultado === false) {

        echo "Erro ao excutar o comando sql" . ' ' . mysqli_errno($mysqli) . ' ' . ':' . ' ' . mysqli_error($mysqli);

        die ();
    }

    return $resultado;
}
