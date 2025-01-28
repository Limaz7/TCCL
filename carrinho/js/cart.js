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

        // Verifica se o usuário está logado
        if (!isUserLoggedIn) {
            M.toast({
                html: 'Você precisa estar logado para adicionar o ingresso ao carrinho.',
                classes: '#c62828 red darken-3'
            });
            return; // Interrompe a execução se não estiver logado
        }

        if (tipoUser == 3){
            M.toast({
                html: 'Você só pode comprar o ingresso se for um participante.',
                classes: '#c62828 red darken-3'
            });
            return;
        }

        var form = {
            product: $(this).data('value'),
            id: $(this).data('id-ing'),
            idEvento: $(this).data('id')
        };

        var url = "carrinho/ajax/cart/buy.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',
            success: function (response) {
                if (response.message) {
                    M.toast({ html: response.message, classes: response.status === 'success' ? '#558b2f light-green darken-3' : '#c62828 red darken-3' });
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