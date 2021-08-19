$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').select2();

    $(document).on('click', '.btn_entrega_aceito', function(){
        var btn = $(this);

        btn.removeClass('btn_entrega_aceito').removeClass('btn-dark').addClass('btn-success').html('ACEITO');

        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {id: btn.data('id')},
            success: (data) => {
                // console.log(data);

                $('#status-'+btn.data('id')).removeClass('btn-dark').addClass('btn-primary').html('EM ENTREGA');
            },
            error: (err) => {
                // console.log(err);
            }
        });
    });

    $(document).on('click', '.caixa_devolvida', function(){
        var btn = $(this);
        var devolvida = '';

        if(btn.attr('data-devolvida') == 'S'){
            devolvida = btn.attr('data-devolvida');
            btn.attr('data-devolvida', 'N');
            btn.removeClass('btn-dark').addClass('btn-success').html('SIM');
        }else{
            devolvida = btn.attr('data-devolvida');
            btn.attr('data-devolvida', 'S');
            btn.removeClass('btn-success').addClass('btn-dark').html('NÃO');
        }

        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {id: btn.data('id'), devolvida: devolvida},
            success: (data) => {
                // console.log(data);

                // $('#status-'+btn.data('id')).removeClass('btn-primary').addClass('btn-success').html('ENTREGUE');
            },
            error: (err) => {
                // console.log(err);
            }
        });
    });

    $(document).on('click', '.btn_entregue', function(){
        var btn = $(this);

        btn.removeClass('btn_entregue').removeClass('btn-primary').addClass('btn-success').html('ENTREGUE');

        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {id: btn.data('id')},
            success: (data) => {
                // console.log(data);

                // $('#status-'+btn.data('id')).removeClass('btn-primary').addClass('btn-success').html('ENTREGUE');
            },
            error: (err) => {
                // console.log(err);
            }
        });
    });

    $(document).on('click', '.btn_liberar_pedido', function(){
        var btn = $(this);

        btn.removeClass('btn_liberar_pedido').removeClass('btn-dark').addClass('btn-success').html('LIBERADO');

        $.ajax({
            url: btn.data('route'),
            type: 'POST',
            data: {id: btn.data('id')},
            success: (data) => {
                // console.log(data);

                // $('#status-'+btn.data('id')).removeClass('btn-primary').addClass('btn-success').html('ENTREGUE');
            },
            error: (err) => {
                // console.log(err);
            }
        });
    });

    $(document).on('click', '.btn-editar-user',function(){
        var btn = $(this);

        $.each(btn.data('dados'), (key, value) => {
            $('#modalUsersEdit').find('[name="'+key+'"]').val(value);
        });
    });

    $(document).on('click', '[data-target="#entregadorModal"]', function(){
        $('#entregadorModal').find('[name="id"]').val($(this).data('id'));
    });
    // Função salva dados gerais
    $(document).on('click', '.btn-save', function(){
        // Pegamos os dados do data
        let save_target = $(this).data('save_target');
        let save_route = $(save_target).find('form').attr('action');

        // Pegamos o parente do id para adicionar um modelo de carregamento
        let modal = $(save_target).find('.modal-content');
        modal.append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>');

        $.ajax({
            url: save_route,
            type: "POST",
            data: $(save_target).find('form').serialize(),
            success: (data) => {
                // console.log(data);
                // Procuramos a div adcionada recentemente para removemos e fechamos o modal
                $(modal).find('.overlay').remove();
                $(modal).parent().parent().modal('hide');

                $('[data-target="#entregadorModal"]').html('ENTREGADOR ATRIBUIDO').removeClass('btn-dark').addClass('btn-info').removeAttr('data-toggle');
            },
            error: (err) => {
                // console.log(err);
                $(modal).find('.overlay').remove();
            }
        });
    });

    $(document).on('click', '#veterinario', function(){
        if($(this).prop('checked')){
            $('#cientifico').removeClass('d-none');
        }else{
            $('#cientifico').addClass('d-none');
        }
    });
});


