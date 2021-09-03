$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[name="unidade"]').on('click', function () {
        var unidade = $(this).val();
        $("#kg").addClass("d-none");
        $("#price_div").addClass("d-none");
        $("#unidade").addClass("d-none");
        $("#kg_total").addClass("d-none");

        if (unidade == 'Kg') {
                $("#kg").removeClass("d-none");
                $("#price_div").removeClass("d-none");

        } else if (unidade == 'Unidade') {
                $("#unidade").removeClass("d-none");
                $("#kg_total").removeClass("d-none");
                $("#price_div").removeClass("d-none");
        }
    });

    $('#ceping').mask('0000-000');

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
    $(document).on('click', '[data-target="#anexarPDF"]', function(){
        $('#anexarPDF').find('[name="id"]').val($(this).data('id'));

        $.ajax({
            url: $(this).data('url')+'/'+$(this).data('id'),
            type: "GET",
            success: (data) => {
                // console.log(data);
                if(data.status){
                    $('.preview_anexo').html('<iframe src="'+data.anexo+'" width="100%" height="450px" style="border: none;"></iframe>');
                    $('.anexo').addClass('d-none');
                    $('.btn-save-pdf').addClass('d-none');
                }else{
                    $('.preview_anexo').empty();
                    $('.anexo').removeClass('d-none');
                    $('.btn-save-pdf').removeClass('d-none');
                }
            }
        });
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

    $('.anexo').on("change", function(){
        var anexo = $(this);
        $('.preview_anexo').empty();

        var preview = $('.preview_anexo');
        var files   = anexo.prop('files');

        var reader  = new FileReader();
        reader.onloadend = function () {
            preview.html('<iframe src="'+reader.result+'" width="100%" height="450px" style="border: none;"></iframe>');
        }
        reader.readAsDataURL(files[0]);
    });

    // Função salva dados gerais
    $(document).on('click', '.btn-save-pdf', function(){
        // Pegamos os dados do data
        let btn = $(this);
        let save_target = $(this).data('save_target');
        let save_route = $(save_target).find('form').attr('action');

        // Pegamos o parente do id para adicionar um modelo de carregamento
        let modal = $(save_target).find('.modal-content');
        modal.append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>');

        $.ajax({
            url: save_route,
            type: "POST",
            data: new FormData($(save_target).find('form')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                // console.log(data);
                // Procuramos a div adcionada recentemente para removemos e fechamos o modal
                $(modal).find('.overlay').remove();
                $(modal).parent().parent().modal('hide');
            },
            error: (err) => {
                // console.log(err);
                $(modal).find('.overlay').remove();
            }
        });
    });

    $(document).on('click', '.btn-trash', function(e){
        e.preventDefault();

        var btn = $(this);

        Swal.fire({
            icon: 'info',
            title: 'Gostaria de apagar essa encomenda?',
            showCancelButton: true,
            confirmButtonText: 'SIM',
            cancelButtonText: 'NÃO',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = btn.attr('href');
            }
        });
    })
});


