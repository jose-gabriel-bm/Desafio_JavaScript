$(function () {
    var atual_fs, next_fs, prev_fs;
    function next(elem) {
        atual_fs = $(elem).parent();
        next_fs = $(elem).parent().next();
        $('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo');
        atual_fs.hide(800);
        next_fs.show(800);
    }
    $('.prev').click(function () {
        atual_fs = $(this).parent();
        prev_fs = $(this).parent().prev();
        $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
        atual_fs.hide(800);
        prev_fs.show(800);
    });
    $('input[name=next1]').click(function () {
        let nome = document.getElementById('nome').value;
        let cpf = document.getElementById('cpf').value;
        let email = document.getElementById('email').value;

        if (nome == '' || cpf == '' || email == '') {
            let mensageErro = 'E obrigatorio o preenchimento de todos os campos'
            adicionarMensagemErro(mensageErro);

        } else {
            if (cpf.length != 11 && cpf != '') {
                let mensageErro = 'O campo CPF deve conter 11 digitos'
                adicionarMensagemErro(mensageErro);
            } else {
                next($(this));
                $('.mensagem').html('');
            }
        }
    });

    $('input[name=next2]').click(function () {
         let numero = document.getElementById('numero').value;
         let ddd = document.getElementById('ddd').value;
         let codigo_pais = document.getElementById('codigo_pais').value
         if (numero.length < 8 || numero.length > 9) {
             let mensageErro = 'O campo numero deve conter de 8 a 9 digitos'
             adicionarMensagemErro(mensageErro);
         } else if (ddd.length != 2 || codigo_pais.length != 2) {
             let mensageErro = 'O campo DDD e codigo do pais deve conter apenas 2 digitos'
             adicionarMensagemErro(mensageErro);
         } else if (ddd == '' || codigo_pais == '' || codigo_pais == '') {
            let mensageErro = ' E obrigatorio o preechimento de todos os campos'
            adicionarMensagemErro(mensageErro);
         } else {
            $('.mensagem').html('');
            next($(this));
         }
    });

    $('input[type=submit]').click(function (evento) {

        let validCep = document.getElementById('cep').value;
        let validLogradouro = document.getElementById('logradouro').value;
        let validBairro = document.getElementById('bairro').value;
        let validNumero = document.getElementById('nCasa').value;

        if(validCep == '' || validLogradouro == '' || validBairro == ''|| validNumero == '') {
            let mensageErro = ' E obrigatorio o preenchimento dos 6 primeiros campos'
            adicionarMensagemErro(mensageErro);
        }else if(validCep.length < 8 || validCep.length > 10){
            let mensageErro = ' Formato de Cep invalido,o mesmo deve conter entre 8 a 10 digitos'
            adicionarMensagemErro(mensageErro);
        }else if(validNumero.length > 10){  
            let mensageErro = ' Campo numero contem mais de 10 caracteres'
            adicionarMensagemErro(mensageErro);
        }else{ 
        $('.mensagem').html('');

        var contatos = document.getElementsByClassName('contato');
        var select = document.getElementById('cidade')
        var id_cidade = select.children[select.selectedIndex];

        let tamanho = contatos.length;
        tamanho = tamanho / 3;

        posicaoCodigoPais = 0;
        posicaoDdd = 1;
        posicaoNumero = 2;

        var array = [];

        for (let i = 0; i < tamanho; i = i + 1) {

            array.push(
                {
                    codigo_pais: contatos[posicaoCodigoPais].value,
                    ddd: contatos[posicaoDdd].value,
                    numero: contatos[posicaoNumero].value,
                }
            );

            posicaoCodigoPais = posicaoCodigoPais + 3;
            posicaoDdd = posicaoDdd + 3;
            posicaoNumero = posicaoNumero + 3;
        }

        let dados = {
            dadosPessoais: {
                nome: nome.value,
                cpf: cpf.value,
                email: email.value
            },
            endereco: {
                logradouro: logradouro.value,
                nCasa: nCasa.value,
                complemento: complemento.value,
                bairro: bairro.value,
                cep: cep.value,
                id_cidade:id_cidade.value
            },
            contatos: {
                array
            }
        }
        console.log(dados);
        enviarRequisicao(dados);
        }
        evento.preventDefault();
    });
    function enviarRequisicao(dados){
        
        $.ajax({
            type: 'post',
            url: 'adicionar',
            data: { dados },
            // dataType: 'json',
            beforeSend: function () {
            },
            success: function (valor) {
                if (valor.sucesso === false) {
                    $('.mensagem').html(`<div class="erro"><p> Falha ao salvar: ${valor.chave} ${valor.mensagem} </p></div>`);
                } else {
                    alert('Salvo com sucesso');
                    window.location.href = 'http://localhost:8765/clientes'
                }
            }
        });
    }
    function adicionarMensagemErro(mensageErro){

        let elementoRef = document.getElementById("mensagem");
        elementoRef.innerText = "";
        
        let div = document.createElement("div");
        let nomeDiv = `erro`;
        let atributo = document.createAttribute("class");
        atributo.value = nomeDiv;
        div.setAttributeNode(atributo);
        console.log(div);
        let texto = document.createTextNode(mensageErro)
        div.appendChild(texto);
        elementoRef.appendChild(div);
    }

});

var contador = 1;

function adicionarNovoContato() {

    // criação de um elemento Div.
    let div = document.createElement("div");
    let nomeDiv = `div${contador}`;
    let atributo = document.createAttribute("class");
    atributo.value = nomeDiv;
    div.setAttributeNode(atributo);

    var elementoReferencia = document.getElementById("addContato");
    var elementoPai = elementoReferencia.parentNode;

    elementoPai.insertBefore(div, elementoReferencia);

    // adição html no elemento criado.
    $(`div.${nomeDiv}`).html(`
        <h2 class="h2novocontato">Contato ${contador}</h2>
        <input type="button" class="apagarContato" id="apagarContato" value="X" onclick="removerCampoContato()"></input>
        <input type="text" class="contato" name="codigo_pais${contador}" id="codigo_pais${contador}" placeholder="Codigo do pais: 55" default="55"/>
        <input type="text" class="contato" name="ddd${contador}" id="ddd${contador}" placeholder="DDD: 62" default="62"/>
        <input type="text" class="contato" name="numero${contador}" id="numero${contador}" placeholder="Numero: 0000-0000" required />
        <input type="hidden" name="principal${contador}" id="principal${contador}" value="1" required ></input>
        <input type="hidden" name="whatsapp${contador}" id="whatsapp${contador}" value="1" required ></input>`);
    contador = contador + 1;

}

function removerCampoContato() {

    var button = document.getElementById("apagarContato");
    var buttonAdicionar = document.getElementById("addContato");

    if (button.parentNode) {
        button.parentNode.remove();
        buttonAdicionar.setAttribute("type", "button");
    }
}

function selecionarCidades(cidade){
    var idEstado = document.getElementById("estado").value;    
    $.ajax({
        type: 'POST',
        url: 'selecionarcidade',
        dataType: 'json',
        data: { idEstado },
        beforeSend: function () {
        },
        success: function (resposta) {
            if(resposta){
                let elementoReferencia = document.getElementById('cidade');
                elementoReferencia.innerText = "";

                resposta.map(function(respost, i) {                   
                    criacaoOptionsCidades(elementoReferencia,respost,cidade);
                })
            }
        }
    });
    
}

 function criacaoOptionsCidades(elementoReferencia,respost,cidade){
     
    let option = document.createElement("option");

    let value = document.createAttribute('value');
    value.value = respost.id;

    option.setAttributeNode(value);


    if(cidade){

        if(respost.nome = cidade){

            let selected = document.createAttribute('selected');
            selected.value = true;
    
            option.setAttributeNode(selected);
        }
    }
      
    option.text = respost.nome;
    elementoReferencia.appendChild(option);

}

const cep = document.querySelector("#cep");

cep.addEventListener("blur", (e) => {
    let pesquisa = cep.value.replace("-", "");
    const opcoes = {
        method: "GET",
        mode: "cors",
        cache: "default"
    }
    fetch(`https://viacep.com.br/ws/${pesquisa}/json/`, opcoes)
        .then(response => {
            response.json()
                .then(data => show(data))
        }).catch(e => console.log("deu erro" + e.menssage))

})

const show = (result) => {
    
    for (const campo in result) {
        if (document.querySelector("#" + campo)) {
            document.querySelector("#" + campo).value = result[campo]
        }
    }

    let uf = result['uf'];
    let campoEstado = document.getElementById(uf);

    let selected = document.createAttribute('selected');
    selected.value = true;

    campoEstado.setAttributeNode(selected);

    var cidade = result['localidade'];

    selecionarCidades(cidade);
}