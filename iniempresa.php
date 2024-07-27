<?PHP

include_once "cruds/conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    Bem vindo! <?php echo $_SESSION['user'][1]; ?>

    <h4>
        <p><a href="cruds/crudeventos/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>

    <a href="logout.php">Sair</a>

    <?php
    while ($dados = mysqli_fetch_assoc($result)) {
        $arq = $dados['imagem'];

        echo '<h4>' . 'Empresa organizadora: </h4>' .  $dados['nome_empresa'];
        echo '<h4>' . 'Evento: ' . $dados['nome_evento'] . '</h4>';
        echo '<h4>' . 'Descrição: ' . $dados['descricao'] . '</h4>';
        echo '<h4>' . 'data: ' . $dados['data'] . '</h4>';
        echo '<a href="cruds/crudeventos/formedit?id_eventos='.$dados['id_eventos'].'">Editar evento</a><br>';

        echo "<img src='cruds/imagens/$arq' width='100px' height='100px'><br>";
    }
    ?>

</body>

</html>