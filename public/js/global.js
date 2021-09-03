function validateNIF(nif){
    if(nif.length == 9){
        added = ((nif[7]*2)+(nif[6]*3)+(nif[5]*4)+(nif[4]*5)+(nif[3]*6)+(nif[2]*7)+(nif[1]*8)+(nif[0]*9));
        mod = added % 11;
        if(mod == 0 || mod == 1){
            control = 0;
        } else {
             control = 11 - mod;   
        }
        
        if(nif[8] == control){
            return true;
        } else {
             return false;  
        }
    } else {
        return false;
    }
}

$(document).on('blur','#NIF', function(){
    if(validateNIF($("#NIF").val())){
        $('#msg').html('V&aacute;lido');
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'NIF Inválido!',
          }).then(function(){
            $('#NIF').focus();
          });
         
    }
    
});