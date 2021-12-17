function selecionarCidades(){
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
                    criacaoOptionsCidades(elementoReferencia,respost);
                })
            }
        }
    });
    
}

function criacaoOptionsCidades(elementoReferencia,respost){
     
    let option = document.createElement("option");

    let value = document.createAttribute('value');
    value.value = respost.id;

    option.setAttributeNode(value);
      
    option.text = respost.nome;
    elementoReferencia.appendChild(option);

}
function salvarDados(){

    var contatos = document.getElementsByClassName('contatoEdit');
    let status = document.getElementById('status').value

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
            email: email.value,
            status: status
        },
        endereco: {
            logradouro: logradouro.value,
            numero: nCasa.value,
            complemento: complemento.value,
            bairro: bairro.value,
            cep: cep.value,
        },
        contatos: {
            array
        }
    }

    validarCampos(dados, array)   
    
}
function validarCampos(dados,  array){

    let camposVaziosContatos = 0;
    array.forEach(function(campo, i) {
        if(campo['codigo_pais'] == '' || campo['ddd'] == '' || campo['numero'] == ''){
            camposVaziosContatos = '1';
        }
    });

    if(dados['dadosPessoais']['nome'] == '' || dados['dadosPessoais']['email'] == ''|| dados['dadosPessoais']['cpf'] == ''){
        let mensageErro = ' E obrigatorio o preechimento de todos os campos de Dados pessoais';
        adicionarMensagemErro(mensageErro)
    }else if(dados['endereco']['logradouro'] == '' || dados['endereco']['numero'] == ''|| dados['endereco']['bairro'] == ''|| dados['endereco']['cep'] == ''){
        let mensageErro = ' E obrigatorio o preechimento dos 4 primeiros campos de Endereço';
        adicionarMensagemErro(mensageErro)
    }else if(dados['dadosPessoais']['cpf'] .length != 11 && dados['dadosPessoais']['cpf']  != ''){
        let mensageErro = 'O campo CPF deve conter 11 digitos'
        adicionarMensagemErro(mensageErro);
        document.getElementById("cpf").focus();
    }else if(dados['endereco']['cep'].length < 8 || dados['endereco']['cep'].length > 10){
        let mensageErro = ' Formato de Cep invalido,o mesmo deve conter entre 8 a 10 digitos'
        adicionarMensagemErro(mensageErro);
        document.getElementById("cep").focus();
    }else if(dados['endereco']['numero'].length > 10){
        let mensageErro = ' Campo numero contem mais de 10 caracteres'
        adicionarMensagemErro(mensageErro);
    }else if(camposVaziosContatos == '1'){
        let mensageErro = ' E obrigatorio o preechimento de todos os campos de Contatos'
        adicionarMensagemErro(mensageErro);
    }else{
        $('.mensagem').html('');
        enviarDados(dados);
    }
   
}
var contador = 9;
function adicionarNovoContato(){

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
        <div id ="contato${contador}">
        <input type="button" class="apagarContato" id ="contato${contador}" value="X" ></input>
        <input type="text" class="contatoEdit" name="codigo_pais${contador}" id="codigo_pais${contador}" placeholder="Codigo do pais: 55" default="55"/>
        <input type="text" class="contatoEdit" name="ddd${contador}" id="ddd${contador}" placeholder="DDD: 62" default="62"/>
        <input type="text" class="contatoEdit" name="numero${contador}" id="numero${contador}" placeholder="Numero: 0000-0000" required />
        </div>
         `);
     contador = contador + 1;
}
function enviarDados(dados) {
    $.ajax({
        type: 'put',
        url: '',
        data: { dados },
        // dataType: 'json',
        beforeSend: function () {
        },
        success: function (valor) {
            if (valor.sucesso === false) {
                alert(`Falha ao salvar: ${valor.chave} ${valor.mensagem} `);
                $('.mensagem').html(`<div class="erro"><p> Falha ao salvar: ${valor.chave} ${valor.mensagem} </p></div>`);
            } else {
                alert('Salvo com sucesso');
                window.location.href = 'http://localhost:8765/clientes'
            }
        }
    });
}

function adicionarMensagemErro(mensageErro) {

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
function adicionarMensagemSucesso(mensageSucesso) {

    let elementoRef = document.getElementById("mensagem");
    elementoRef.innerText = "";

    let div = document.createElement("div");
    let nomeDiv = `sucesso`;
    let atributo = document.createAttribute("class");
    atributo.value = nomeDiv;
    div.setAttributeNode(atributo);
    console.log(div);
    let texto = document.createTextNode(mensageSucesso)
    div.appendChild(texto);
    elementoRef.appendChild(div);
}

function redirecionarTelaIndex(){
    location.href = `http://localhost:8765/clientes/index`
}

$("form").on("click", ".apagarContato", function () {
    var button_id = $(this).attr("id");

    $('#' + button_id + '').remove();
})