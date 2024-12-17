<?php
include('../conexao.php');
$conexao = conectar();

$sql = "SELECT * FROM ingressos_cadastrados";
$result = executarSQL($conexao, $sql);

$valores_ingressos = []; // Array para armazenar os valores
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Ingressos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">



            <h2>Valor dos ingressos: <span id="valor-total">R$ 0,00</span></h2>

            <?php $i = 0;
            while ($dados_ingresso = mysqli_fetch_assoc($result)): ?>
                <?php $valores_ingressos[] = $dados_ingresso['valor']; ?> <!-- Adiciona o valor ao array -->

                <div class="ingresso">
                    <h4>Pista</h4>
                    <p>1º Lote Unissex OPEN BAR R$ <?= number_format($dados_ingresso['valor'], 2, ',', '.'); ?></p>
                    <div class="quantidade">
                        <button class="decremento" onclick="alterarQuantidade(-1, <?= $i; ?>)">-</button>
                        <span id="qtd-<?= $i; ?>">0</span>
                        <button class="incremento" onclick="alterarQuantidade(1, <?= $i; ?>)">+</button>
                    </div>
                </div>
            <?php $i++;
            endwhile; ?>

            <a href="#">aaaaaaaaaaa</a>


    </div>


    <!-- Passando o array PHP para o JavaScript -->
    <script>
        const precos = <?php echo json_encode($valores_ingressos); ?>; // Array com os valores dos ingressos
        console.log(precos); // Debug: Confirmação dos valores no console
    </script>
    <script src="script.js"></script>
</body>

</html>