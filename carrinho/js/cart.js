$(document).ready(function () {

    // Atualiza o contador do menu ao clicar em um botão específico
    $(document).on('click', '.buy', function () {
        $('#counter').load("informacoes.php #counter");
    });

    // Atualiza o conteúdo do carrinho ao clicar em um botão específico
    $(document).on('click', '.plus, .minus', function () {
        $('#cart').load("cart.php #loader");
    });

    //Comprar produto
    $('body').on('click', '.buy', function (l) {
        l.preventDefault();

        var form = $(this).data('value');
        var idIngresso = $(this).data('id');
        var url = "carrinho/ajax/cart/buy.php";

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',

            success: function (data, textStatus, jqXHR) {
                if (data['status'] == 'success') {
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-circle">' + data['message'] + '</span></p></div></div></div>');
                } else {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-info-exclamation-triangle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'info') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-info-circle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'warning') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-times-circle">' + data['message'] + '</span></p></div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();

                    if (data['redirect'] != '') {
                        window.location.href = data['redirect'];
                    }
                }, 3000);

            }

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

            success: function (data, textStatus, jqXHR) {
                if (data['status'] == 'success') {
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-circle">' + data['message'] + '</span></p></div></div></div>');
                } else {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-info-exclamation-triangle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'info') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-info-circle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'warning') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-times-circle">' + data['message'] + '</span></p></div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();

                    if (data['redirect'] != '') {
                        window.location.href = data['redirect'];
                    }
                }, 3000);

            }

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

            success: function (data, textStatus, jqXHR) {
                if (data['status'] == 'success') {
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-circle">' + data['message'] + '</span></p></div></div></div>');
                } else {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-info-exclamation-triangle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'info') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-info-circle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'warning') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-times-circle">' + data['message'] + '</span></p></div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();

                    if (data['redirect'] != '') {
                        window.location.href = data['redirect'];
                    }
                }, 3000);

            }

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

            success: function (data, textStatus, jqXHR) {
                if (data['status'] == 'success') {
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-circle">' + data['message'] + '</span></p></div></div></div>');
                } else {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-info-exclamation-triangle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'info') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-check-info-circle">' + data['message'] + '</span></p></div></div></div>');
                } if (data['status'] == 'warning') {
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-' + data['status'] + '"><div class"status-message"><p><span class="fa fa-times-circle">' + data['message'] + '</span></p></div></div></div>');
                }

                setTimeout(function () {
                    $('#status-container').hide();

                    if (data['redirect'] != '') {
                        window.location.href = data['redirect'];
                    }
                }, 3000);

            }

        });
    });
});