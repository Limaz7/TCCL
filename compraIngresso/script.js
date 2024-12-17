function alterarQuantidade(valor, id) {
    const quantidadeElement = document.getElementById(`qtd-${id}`);
    let quantidadeAtual = parseInt(quantidadeElement.innerText);

    // Atualizar quantidade
    quantidadeAtual += valor;
    if (quantidadeAtual < 0) quantidadeAtual = 0; // Não permitir valores negativos
    quantidadeElement.innerText = quantidadeAtual;

    // Recalcular o valor total
    atualizarValorTotal();
}

function atualizarValorTotal() {
    let total = 0;

    for (let i = 0; i < precos.length; i++) {
        const quantidade = parseInt(document.getElementById(`qtd-${i}`).innerText);
        total += quantidade * precos[i]; // Multiplica a quantidade pelo preço correspondente
    }

    document.getElementById('valor-total').innerText = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Inicializa o valor total padrão
atualizarValorTotal();
