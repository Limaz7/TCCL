<?php

function conectar()
{

    require_once "cruds/config.php";

    $conexao = mysqli_connect(

        $config['host'],
        $config['user'], 
        $config['pass'], 
        $config['bd'],
    
    );

    if ($conexao === false) {

        echo "Erro ao conectar com o banco de dados. N° do erro:" .
            mysqli_connect_errno() . " " . 
            mysqli_connect_error();
        die();
    }

    return $conexao;
}

function executarSQL($conexao, $sql)
{

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado === false) {

        echo "Erro ao excutar o comando sql" . ' ' . mysqli_errno($conexao) . ' ' . ':' . ' ' . mysqli_error($conexao);

        die ();
    }

    return $resultado;
}
