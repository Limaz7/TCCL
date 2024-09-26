<?PHP

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT e.*, en.* FROM eventos e 
        JOIN enderecos en ON e.id_evento= en.id_evento";
$result = executarSQL($conexao, $sql);
    
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php require "headers.php" ?>

    <title>Inicio</title>
</head>

<body>

    <h4>
        <p><a href="crudevento/formcadeventos.php">Cadastrar eventos</a></p>
    </h4>

    <p><a href="logout.php">Sair</a></p>
    <div class="main">
        <?php
        $counter = 1; // Contador para diferenciar os cards
        while ($dados = mysqli_fetch_assoc($result)) {
            $_SESSION['evento'][0] = $dados['id_evento'];
            $arq = $dados['imagem'];
        ?>
            <div class="card" style="width: 18rem;">
                <img src="imagens/<?= $arq ?>" class="card-img-top" alt="imagem do evento" width="200px" height="150px">
                <div class="card-body">
                    <h5 class="card-title"><?= $dados['nome_evento']; ?></h5>
                    <p class="card-text">Empresa: <?= $dados['nome_empresa']; ?> 
                    Descrição: <p><?= $dados['descricao']; ?></p>
                    Data do evento: <p><?= $dados['data']; ?></p>
                    <h2>Endereço:</h2>
                    <p><?= $dados['rua']; ?>, <?= $dados['numero']; ?>
                        <?= $dados['bairro']; ?></p>
                    <p>CEP: <?= $dados['cep']; ?></p>
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card card-<?= $counter; ?>"> <!-- Adiciona uma classe única para cada card -->
                <img src='imagens/<?= $arq ?>' width="200px" height="150px"><br>
                <div class="text-container">
                    <h1><?= $dados['nome_evento']; ?></h1>
                    <p>Empresa: <?= $dados['nome_empresa']; ?></p>
                    Descrição: <p><?= $dados['descricao']; ?></p>
                    Data do evento: <p><?= $dados['data']; ?></p>
                    <h2>Endereço:</h2>
                    <p><?= $dados['rua']; ?>, <?= $dados['numero']; ?>
                        <?= $dados['bairro']; ?></p>
                    <p>CEP: <?= $dados['cep']; ?></p>
                </div>
                <div class="links">
                    <?php
                    if ($_SESSION['user'][1] == $dados['nome_empresa']) {
                        echo '<p><a class="link edit" href="crudevento/formediteven?id_evento=' . $_SESSION['evento'][0] . '">Editar evento</a></p>';
                        echo '<p><a class="link excluir" href="crudevento/excluireven?id_evento=' . $dados['id_evento'] . '">Excluir evento</a></p>';
                    }
                    ?>
                </div>
            </div>
        <?php
            $counter++; // Somar o contador para o próximo card
        }
        ?>
    </div>
</body>

</html>