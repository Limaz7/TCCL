    <article class="container_main" id="loader">

        <?php

        $Cart = "SELECT c.*, ic.*, e.* FROM carrinhos c 
        INNER JOIN carrinho_ingressos_cadastrados cic
        ON c.id_carrinho = cic.id_carrinho 
        INNER JOIN ingressos_cadastrados ic
        ON ic.id_ingresso = cic.id_ingresso
        INNER JOIN eventos e ON e.id_evento = ic.id_evento
        WHERE cart_session = '" . $_SESSION['cart'] . "' AND pago = 0 AND c.id_usuario=" . $_SESSION['user'][0];
        $Cart = executarSQL($conexao, $Cart);   

        $lines = mysqli_num_rows($Cart);

        if ($lines == 0):
            echo "<div class='cart_empty'>
                    <h1><span class='fa fa-shopping-cart'></span></h1>
                    <p>Seu carrinho está vazio, compre agora!</p>
                </div>";
        else:
            $total = 0;

            while ($Show = mysqli_fetch_assoc($Cart)) :
                $total += $Show['cart_total'];
                // Exibição do conteúdo do carrinho

        ?>

                <section class="container_cart">

                    <input type="hidden" name="cart_id" value="<?= strip_tags($Show['id_carrinho']); ?>">
                    <input type="hidden" name="nome_ingresso" value="<?= strip_tags($Show['nome_ingresso']); ?>">
                    <input type="hidden" name="imagem" value="<?= strip_tags($Show['imagem']); ?>">
                    <input type="hidden" name="quantidade" value="<?= strip_tags($Show['quantidade']); ?>">
                    <input type="hidden" name="cart_valor" value="<?= number_format($Show['ingresso_valor'], 2, '.', ''); ?>">
                    <input type="hidden" name="id_ingresso" value="<?= strip_tags($Show['id_ingresso']); ?>">

                    <div class="cart_img">
                        <a href="../inicial.php" title="Produto:"><img src="../imagens/<?= strip_tags($Show['imagem']); ?>" title="Produto: " alt="Produto: "></a>
                    </div>

                    <div class="cart_title">
                        <p><?= strip_tags(mb_strtoupper($Show['nome_ingresso'])) ?></p>
                    </div>

                    <div class="cart_quantity">
                        <p class="minus" data-id="<?= strip_tags($Show['id_carrinho']) ?>"><span class="fa fa-minus-circle"></span></p>
                        <span><input class="quantity loader" name="quantity_<?= strip_tags($Show['id_carrinho']) ?>" type="text" value="<?= strip_tags($Show['quantidade']) ?>" class="quantity" readonly></span>
                        <p class="plus" data-id="<?= strip_tags($Show['id_carrinho']) ?>"><span class="fa fa-plus-circle"></span></p>
                    </div>

                    <div class="cart_value">
                        <p class="value" id="loader1">R$ <span class="price"><?= number_format($Show['ingresso_valor'], 2, ',', '.') ?></span></p>
                    </div>

                    <div class="cart_delete">
                        <p><a data-id="<?= strip_tags($Show['id_carrinho']) ?>" class="delete" title="Remover este produto do carrinho"><span class="fa fa-times-circle"></span></a></p>
                    </div>

                    <div class="clear"></div>
                </section>

            <?php endwhile; ?>

            <section class="container_cart">
                <div class="cart_values" id="loader2">
                    <p><span class="value">VALOR TOTAL: R$ <span class="result_final"><?= number_format($total, 2, ',', '.'); ?></span></span></p>
                </div>
            </section>
        <?php endif; ?>

    </article>