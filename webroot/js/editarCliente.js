function salvarDados(){

    var contatos = document.getElementsByClassName('contatoEdit');

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

     enviarDados(dados);
    
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
            // if (valor.sucesso === false) {
            //     $('.mensagem').html(`<div class="erro"><p> Falha ao salvar: ${valor.chave} ${valor.mensagem} </p></div>`);
            // } else {
            //     alert('Salvo com sucesso');
            //     window.location.href = 'http://localhost:8765/clientes'
            // }
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

$("form").on("click", ".apagarContato", function () {
    var button_id = $(this).attr("id");

    $('#' + button_id + '').remove();
})