<?php

session_start();
session_regenerate_id(true);

include_once "../conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM usuarios WHERE id_usuario=" . $_SESSION['user'][0];
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil</title>
</head>

<?php include ("../headers.php"); ?>
<body>
    <div class="container">
        <div style="margin-top: 20%;" class="card-panel">
            <h1> Meus dados </h1>
            <a href="formalterarsenha.php"> Alterar sua senha </a> <br><br>
            <form action="editperf.php" method="post">
                <label for="nome">
                    Nome: <input type="text" name="nome" id="nome" value="<?= $dados['nome']; ?>">
                </label> <br> <br>
                <label for="email">
                    Email: <input type="text" name="email" id="email" value="<?= $dados['email']; ?>">
                </label> <br>
                <p><a href="excluirperfil.php">Excluir seu perfil</a></p>
                <a href="../inicial.php">Voltar</a> <br><br>
                <input style="background: black; color: white;" class="waves-effect waves-light btn" type="submit" value="Enviar">
        </div>
    </div>
</body>

</html>