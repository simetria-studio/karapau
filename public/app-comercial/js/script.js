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

      $('[name="telemovel_empresa"], [name="telefone_empresa"], [name="telemovel_propietario"]').mask('+000 000000000');
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