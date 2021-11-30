$(function(){
    var atual_fs, next_fs, prev_fs;
    var formulario = $('form[name=formulario]');

    function next(elem){
        atual_fs = $(elem).parent();
        next_fs = $(elem).parent().next();

       $('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo');
       atual_fs.hide(800); 
       next_fs.show(800);
    }

    $('.prev').click(function(){
        atual_fs = $(this).parent();
        prev_fs = $(this).parent().prev();

       $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
       atual_fs.hide(800); 
       prev_fs.show(800);
    });

    $('input[name=next1]').click(function(){
        $('.mensagem').html('');
    });

    $('input[name=next1]').click(function(){
        
        var nome = document.getElementById('nome').value;
        var cpf = document.getElementById('cpf').value;
        var email = document.getElementById('email').value;

        if(nome == '' && cpf == ''){
            $('.mensagem').html('<div class="erro"><p> Os campos Nome e CPF e obrigatorio</p></div>');
        }

        if(nome == ''){
            $('.mensagem').html('<div class="erro"><p> O campo Nome e obrigatorio</p></div>');
        }

        if(cpf == ''){
            $('.mensagem').html('<div class="erro"><p> O campo CPF e obrigatorio</p></div>');
        }
        
        if(cpf.length != 11 && cpf != ''){
            $('.mensagem').html('<div class="erro"><p> O campo CPF deve conter 11 digitos</p></div>');
        }else{  
            if(nome != '' && cpf != ''){
                next($(this));
                $('.mensagem').html('');
            }
        }
    });

    $('input[name=next2]').click(function(){
        var numero = document.getElementById('numero').value;

        if(numero == ''){
                $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento do campo Numero</p></div>');
        }

        if(numero != '' && numero.length != 8){
            $('.mensagem').html('<div class="erro"><p> O campo numero deve conter 8 digitos</p></div>');
        }else{

            if(numero != ''){
                $('.mensagem').html('');
                next($(this));
                }

            } 
    });


});