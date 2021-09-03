$.fn.materializeInputs = function (selectors) {

      // default param with backwards compatibility
      if (typeof (selectors) === 'undefined') selectors = "input, textarea, select";

      // attribute function
      function setInputValueAttr(element) {
            element.setAttribute('value', element.value);
      }

      // set value attribute at load
      this.find(selectors).each(function () {
            setInputValueAttr(this);
      });

      // on keyup and change
      this.on("keyup change", selectors, function () {
            setInputValueAttr(this);
      });
};

/**
 * Material Inputs
 */
$('body').materializeInputs();


function hide() {
      $('.balance').addClass('d-none');
      $('.eye').addClass('d-none');
      $('.eye-close').removeClass('d-none');
}
function show() {
      $('.balance').removeClass('d-none');
      $('.eye').removeClass('d-none');
      $('.eye-close').addClass('d-none');
}
$(document).ready(function() {
      $('.accordition-header').on('click',function() {
            $('.accordition-header').not(this).next().slideUp();
            $(this).next().slideToggle();
      });

      $('[name="ddd_telemovel"], [name="ddd_telemovel_empresa"], [name="ddd_telefone_empresa"], [name="ddd_telemovel_propietario"]').mask('+000');
      $('[name="telemovel_empresa"], [name="telefone_empresa"], [name="telemovel_propietario"], [name="telemovel"]').mask('000000000');
});

$('#buscaring').on('click', function() {
      $value = $('#ceping').val();
      $.ajax({
            type: 'get',
            url: '/consultor/adress/cep',
            data: {
                  'search': $value
            },
            success: function(data) {
                  console.log(data);
                  $('#morada').val(data.Morada);
                  $('#regiao').val(data.Localidade);
                  $('#distrito').val(data.Distrito);
                  $('#conselho').val(data.Concelho);
                  $('#freguesia').val(data.Freguesia);
                  $('#latitude').val(data.Latitude);
                  $('#longitude').val(data.Longitude);
            }
      });
});

$(document).on('click', '.add-embarcacao', function(){
      var btn = $(this);
      btn.parent().parent().find('.embarcacao-'+btn.data('embarcacao')).removeClass('d-none').prepend('<input type="text" placeholder="Embarcação '+btn.data('embarcacao')+'" name="nome_embarcacao_'+btn.data('embarcacao')+'">');
      btn.remove();
});

$('#form-login').find('input').on('keyup', function(e){
      if(e.keyCode == 13){
            $('#btn-login').trigger('click');
      }
});

$(document).on('click', '#btn-login', function(){
      var btn = $(this);
      var form = $('#form-login').serialize();
      var url = $('#form-login').attr('action');
      btn.html('<div class="spinner-border text-light" role="status"></div>');
      btn.prop('disabled', true);
      $('#form-login').find('input').prop('disabled', true);

      $.ajax({
            url: url,
            type: 'POST',
            data: form,
            success: (data) => {
                  // console.log(data);

                  window.location.href = data;
            },
            error: (err) => {
                  // console.log(err);
                  btn.html('ENTRAR');
                  btn.prop('disabled', false);
                  $('#form-login').find('input').prop('disabled', false);

                  Swal.fire({
                        icon: 'error',
                        title: err.responseJSON.invalid
                  });
            }
      });
});