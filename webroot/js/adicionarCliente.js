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
        }else{

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
    }
    });

    $('input[name=next2]').click(function(){

        let numero = document.getElementById('numero').value;
        let ddd = document.getElementById('ddd').value;
        let codigo_pais = document.getElementById('codigo_pais').value;

        if(numero.length != 8 || ddd.length != 2 || codigo_pais.length != 2){
            
            if(numero.length != 8){
                $('.mensagem').html('<div class="erro"><p>O campo numero deve conter apenas 8 digitos </p></div>');
            }
            if(ddd.length != 2 || codigo_pais.length != 2){
                $('.mensagem').html('<div class="erro"><p>O campo DDD e codigo do pais deve conter apenas 2 digitos </p></div>');
            }
            if(ddd == '' || codigo_pais == '' || codigo_pais == ''){
                $('.mensagem').html('<div class="erro"><p> E obrigatorio o preechimento de todos os campos </p></div>');
            }

        }else{
            $('.mensagem').html('');
            next($(this));
        } 
    });
    
    $('input[type=submit]').click(function(evento){

    var array = formulario.serializeArray();

    $.ajax({
        type: 'post',
        url: 'adicionar',
        data: {cadastrar: 'sim', campos: array},
        // dataType: 'json',
        beforeSend:function(){
            $('.mensagem').html('<div class="erro"><p> Em processamento </p></div>');
        },
        success:function(valor){
            $('.mensagem').html('<div class="sucesso"><p> Salvo com sucesso</p></div>');
        }
        
    });
    evento.preventDefault();
});
    
});

    var contador = 1;

    function adicionarNovoContato(){       

        // criação de um elemento Div.
        let div = document.createElement("div");
        let nomeDiv = `contato${contador}`;
        let atributo = document.createAttribute("class");
        atributo.value = nomeDiv;
        div.setAttributeNode(atributo);

        var elementoReferencia = document.getElementById("addContato");
        var elementoPai = elementoReferencia.parentNode;

        elementoPai.insertBefore(div,elementoReferencia);      

        // adição html no elemento criado.
        $(`div.${nomeDiv}`).html(`
        
        <h2 class="h2novocontato">Contato ${contador}</h2>
        <input type="button" class="apagarContato" id="apagarContato" value="X" onclick="removerCampoContato()"></input>
        <input type="text" name="codigo_pais${contador}" id="codigo_pais${contador}" placeholder="Codigo do pais: 55" default="55"/>
        <input type="text" name="ddd${contador}" id="ddd${contador}" placeholder="DDD: 62" default="62"/>
        <input type="text" name="numero${contador}" id="numero${contador}" placeholder="Numero: 0000-0000" required />`
        );
        contador = contador+1;

        if(contador == '3'){
            elementoReferencia.setAttribute("type", "hidden");     
        }

    }

    function removerCampoContato(){

        var button = document.getElementById("apagarContato");
        var buttonAdicionar = document.getElementById("addContato");

        if(button.parentNode){
            button.parentNode.remove();
            contador = contador-1;
            buttonAdicionar.setAttribute("type", "button");
        }
    }   

    const cep = document.querySelector("#cep");

    cep.addEventListener("blur",(e) =>{
        let pesquisa = cep.value.replace("-","");
        const opcoes = {
            method:"GET",
            mode:"cors",
            cache:"default"
        }
        fetch(`https://viacep.com.br/ws/${pesquisa}/json/`,opcoes)
        .then(response => {
            response.json()
            .then(data => show(data))
        }).catch(e => console.log("deu erro" + e.menssage ))

    })

    const show = (result) => {
        for(const campo in result){
          if(document.querySelector("#"+campo)){
              document.querySelector("#"+campo).value = result[campo]
          }
        }
    }



