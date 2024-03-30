<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar eventos</title>
</head>
<body>
    
    <h1> CRUD EVENTOS </h1>

<?php

    echo "<p><a href=\"formeventos.php\">Cadastrar eventos</a></p>";

    include "../conexao.php";

    $sql = "SELECT * FROM eventos";

    $resultado = mysqli_query($conecta, $sql);

    echo '<table border=1>
    <tr>
        <th>ID EVENTOS</th>
        <th>NOME</th>
        <th>DESCRIÇÃO</th>
        <th>DATA</th>
        <th>IMAGEM</th> 
        <th colspan=3>OPÇÕES</th>
    </tr>';

    while($dados = mysqli_fetch_assoc($resultado)){
        echo '<tr>';
        echo '<td>'.$dados["id_eventos"].'</td>';
        echo '<td>'.$dados["nome"].'</td>';
        echo '<td>'.$dados["descricao"].'</td>';
        echo '<td>'.$dados["data"].'</td>';
        echo '<td><img src='.$dados["imagem"].'></td>';

        echo '<td><a href="formedit?id='.$dados['id_eventos'].'&">Editar</a></td>';
        echo '<td><a href="excluireven?id='.$dados['id_eventos'].'&">Excluir</td>';
        echo '</tr>';
    }

    echo '</table>';
?>
</body>
</html>