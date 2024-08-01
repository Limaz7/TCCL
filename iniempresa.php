<?PHP

include_once "cruds/conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM eventos";
$result = executarSQL($conexao, $sql);

$sql1 = "SELECT * FROM endereco";
$result1 = executarSQL($conexao, $sql1);

session_start();


session_regenerate_id(true);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
   
    <?php  include_once "headers.php" ?>
    


    <title>Inicio</title>
</head>

<body>
    Bem vindo! <?=  $_SESSION['user'][1]; ?>

    <h4>
        <p><a href="cruds/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>

    <a href="logout.php">Sair</a>

    <?php
    while ($dados = mysqli_fetch_assoc($result) and $dados1 = mysqli_fetch_assoc($result1)) {
        $arq = $dados['imagem'];
       

        echo '<h4>' . 'Empresa organizadora: </h4>' .  $dados['nome_empresa'];
        echo '<h4>' . 'Evento: ' . $dados['nome_evento'] . '</h4>';
        echo '<h4>' . 'Descrição: ' . $dados['descricao'] . '</h4>';
        echo '<h4>' . 'data: ' . $dados['data'] . '</h4>';
        echo '<h4>' . 'CEP: ' . $dados1['cep'] . '</h4>';
        echo '<h4>' . 'Número do imóvel: ' . $dados1['numero'] . '</h4>';
        echo '<h4>' . 'Rua: ' . $dados1['rua'] . '</h4>';
        echo '<h4>' . 'Bairro: ' . $dados1['bairro'] . '</h4>';
        echo '<h4>' . 'Cidade: ' . $dados1['cidade'] . '</h4>';
        echo '<h4>' . 'Estado: ' . $dados1['estado'] . '</h4>';
        if ($_SESSION['user'][1] == $dados['nome_empresa']) {
            echo '<p><a href="cruds/formediteven?id_eventos=' . $dados['id_eventos'] . '">
        Editar evento</a></p>';
            echo '<p><a href="cruds/excluireven?id_eventos=' . $dados['id_eventos'] . '">
        Excluir evento</a></p>';
        }
        echo "<img src='cruds/imagens/$arq' width='100px' height='100px'><br>";
    }
    ?>

</body>

</html>