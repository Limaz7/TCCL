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

    <?php include_once "headers.php" ?>

    <title>Inicio</title>
</head>

<body>
    Bem vindo! <?= $_SESSION['user'][1]; ?>

    <h4>
        <p><a href="cruds/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>

    <a href="logout.php">Sair</a>

    <?php
    while ($dados = mysqli_fetch_assoc($result) and $dados1 = mysqli_fetch_assoc($result1)) {
        $arq = $dados['imagem'];

    ?>

        <table class="centered">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Empresa organizadora</th>
                    <th>Evento</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>CEP</th>
                    <th>Número do imóvel</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php 
                    echo "<td><img src='cruds/imagens/$arq' width='100px' height='100px'><br></td>";
                    ?>
                    <td><?= $dados['nome_empresa']; ?></td>
                    <td><?= $dados['nome_evento']; ?></td>
                    <td><?= $dados['descricao']; ?></td>
                    <td><?= $dados['data']; ?></td>
                    <td><?= $dados1['cep']; ?></td>
                    <td><?= $dados1['numero']; ?></td>
                    <td><?= $dados1['rua']; ?></td>
                    <td><?= $dados1['bairro']; ?></td>
                    <td><?= $dados1['cidade']; ?></td>
                    <td><?= $dados1['estado']; ?></td>
                    <?php
                    if ($_SESSION['user'][1] == $dados['nome_empresa']) {
                        echo '<td><p><a href="cruds/formediteven?id_eventos=' . $dados['id_eventos'] . '">
                                Editar evento</a></p></td>';
                        echo '<td><p><a href="cruds/excluireven?id_eventos=' . $dados['id_eventos'] . '">
                                Excluir evento</a></p></td>';
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    <?php
    }
    ?>

</body>

</html>