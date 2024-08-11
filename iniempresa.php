<?PHP

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e 
        JOIN endereco en ON e.id_eventos= en.id_eventos";
$result = executarSQL($conexao, $sql);

session_start();
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php require "headers.php" ?>

    <title>Inicio</title>
</head>

<body>
    Bem vindo! <?= $_SESSION['user'][1]; ?>

    <h4>
        <p><a href="crudevento/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>

    <a href="logout.php">Sair</a>

    <?php
    while ($dados = mysqli_fetch_assoc($result)) {
        $_SESSION['evento'][0] = $dados['id_eventos'];
        $arq = $dados['imagem'];

    ?>

        <table>
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

                    <td><img src='imagens/<?= $arq ?>' width='100px' height='100px'><br></td>

                    <td><?= $dados['nome_empresa']; ?></td>
                    <td><?= $dados['nome_evento']; ?></td>
                    <td><?= $dados['descricao']; ?></td>
                    <td><?= $dados['data']; ?></td>
                    <td><?= $dados['cep']; ?></td>
                    <td><?= $dados['numero']; ?></td>
                    <td><?= $dados['rua']; ?></td>
                    <td><?= $dados['bairro']; ?></td>
                    <td><?= $dados['cidade']; ?></td>
                    <td><?= $dados['estado']; ?></td>
                    <?php
                    if ($_SESSION['user'][1] == $dados['nome_empresa']) {
                        echo '<td><p><a href="crudevento/formediteven?id_eventos=' . $_SESSION['evento'][0] . '">
                                Editar evento</a></p></td>';
                        echo '<td><p><a href="crudevento/excluireven?id_eventos=' . $dados['id_eventos'] . '">
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