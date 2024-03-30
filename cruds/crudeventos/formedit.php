<?php

$id = $_GET["id"];

include "../conexao.php";

$sql = "SELECT * FROM eventos WHERE id_eventos = $id";

$resultado = mysqli_query($conecta, $sql);

$dados = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar eventos</title>
</head>
<body>
    
    <h1> EDITAR EVENTOS </h1>

    <form method="post" action="editareven.php">

        <input type="hidden" value="<?php echo $dados['id_eventos'];?>" name="id"/>
        Nome: <input type="text" value="<?php echo $dados['nome'];?>" name="nome"/> <br>
        Descrição: <input type="text" value="<?php echo $dados['descricao'];?>" name="desc"/><br>
        Imagem: <input type="file" value="<?php echo $dados['imagem'];?>" name="img"/> <br>
        Data: <input type="datetime-local" value="<?php echo $dados['data'];?>" name="data"/> <br>

        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>