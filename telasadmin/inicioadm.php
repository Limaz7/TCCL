<?php

include ('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM usuarios";
$result = executarSQL($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Tela administrador</h1>

<?php while($dados = mysqli_fetch_assoc($result)){ ?>

        <?= $dados['nome']; ?>


    <?php } ?>



</body>
</html>