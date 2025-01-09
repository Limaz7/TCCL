$(document).ready(function () {

    // Atualiza o contador do menu ao clicar em um botão específico
    $(document).on('click', '.buy', function () {
        var idEvento = $(this).data('id'); // Captura o id do ingresso do botão clicado
        $('#counter').load("informacoes.php?id_evento=" + idEvento + " #counter");
    });


    // Atualiza o conteúdo do carrinho ao clicar em um botão específico
    $(document).on('click', '.plus, .minus, .delete', function () {
        $('#cart').load("cart.php #loader");
    });

    //Comprar produto
    $('body').on('click', '.buy', function (l) {
        l.preventDefault();

        var form = { product: $(this).data('value') };
        var url = "carrinho/ajax/cart/buy.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',
            success: function (response) {
                if (response.message) {
                    M.toast({ html: response.message, classes: response.status === 'success' ? 'light-green darken-3' : '#c62828 red darken-3' });
                }
            },
        });
    });

    //Excluir produto
    $('body').on('click', '.delete', function (l) {
        l.preventDefault();

        var form = $(this).attr('data-id');
        var url = "ajax/cart/delete.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',
        });
    });

    //Alterar quantidade do produto [plus]
    $('body').on('click', '.plus', function (l) {
        l.preventDefault();

        var form = $(this).attr('data-id');
        var val = $('.quantity').change().val();
        var url = "ajax/cart/quantity?plus=" + val;

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',
        });
    });

    //Alterar quantidade do produto [minus]
    $('body').on('click', '.minus', function (l) {
        l.preventDefault();

        var form = $(this).attr('data-id');
        var val = $('.quantity').change().val();
        var url = "ajax/cart/quantity?minus=" + val;

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',
        });
    });
});