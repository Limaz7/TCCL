<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar eventos</title>
</head>
<body>
    
    <h1> Cadastrar eventos </h1>

    <form method="post" action="../cadastroeven.php" enctype="multipart/form-data">
        
    <input type="hidden" name="nomeEmp" value="<?php echo $_SESSION['user'][1]; ?>">
    <p>Nome do evento: <input type="text" name="nomeEven" required></p>
    <p>Descrição: <textarea type="text" name="desc" required></textarea></p>
    <p>Data: <input type="datetime-local" name="data" required></p>
    <p>Imagem <input type="file" name="arquivo">
    <p><input type="submit" value="Enviar"></p>


    </form>
</body>
</html>