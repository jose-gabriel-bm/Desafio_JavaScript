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

    $('input[name=prev]').click(function(){
        $('.mensagem').html('');
    });

    $('input[name=next1]').click(function(){
        var array = formulario.serializeArray();
        
        if(array[0].value == '' || array[1].value == '' ){
            
            
                $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento do campo Nome e CPF</p></div>');
            
            if(array[0].value == '' && array[1].value != ''){
                $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento do campo Nome</p></div>');
            }
            if(array[0].value != '' && array[1].value == ''){
                $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento do campo CPF</p></div>');
            }
        }
        else{  
            $('.mensagem').html('');
            next($(this));
        }
    });

    $('input[name=next2]').click(function(){
        var array = formulario.serializeArray();

        if(array[5].value == ''){
            $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento do campo Numero</p></div>');
            
        }else{

            if(array[3].value == '' || array[4].value == ''){
                if(array[3].value == ''){
                    array[3].value = "55";
                }
                if(array[4].value == ''){
                    array[4].value = "62";
                }
            }else{
                $('.mensagem').html('');
                next($(this));
                console.log(array);
            }
        }
    })
});