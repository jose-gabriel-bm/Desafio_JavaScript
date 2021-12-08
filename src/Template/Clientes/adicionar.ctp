<div class="mensagem" id="mensagem"></div>

<div>
    <form method="post" action="/clientes/adicionar" id="formulario" name="formulario">

        <ul id="progress">
            <li class="ativo">Dados Pessoais</li>
            <li>Contato</li>
            <li>Endereco</li>
        </ul>

        <fieldset id="dadosPessoais">

            <h2>Dados Pessoais</h2>
            
            <input type="text" name="nome" id="nome" placeholder="Nome"></input>

            <input type="text" name="cpf" id="cpf" placeholder="CPF"></input>
  
		    <input type="email" name="email" id="email" placeholder="Email" ></input>

            <input type="button" name="next1" class="next acao" value="Proximo" /></input>

        </fieldset>
        <fieldset>

            <h2>Contato</h2>

            <input type="text" class="contato" name="codigo_pais" id="codigo_pais" placeholder="Codigo do pais: 55" default="55"></input>

            <input type="text" class="contato" name="ddd" id="ddd" placeholder="DDD: 62" default="62"></input>

            <input type="text" class="contato" name="numero" id="numero" placeholder="Numero: 0000-0000" required ></input>

            <div id="dvcontato">

            <input type="button" name="addContato" id="addContato" class="addContato" value="Adicionar +1 contato" onclick="adicionarNovoContato()"></input>

            </div>

            <input type="button" name="next2" class="next acao" value="Proximo" ></input>
            <input type="button" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
        <fieldset>
            <h2>Endereço</h2>

            <input type="text" name="logradouro" id="logradouro" placeholder="Logradouro:Rua ,Lote ,Quadra " required></input>

            <input type="text" name="nCasa" id="nCasa" placeholder="Numero:"></input>

            <input type="text" name="complemento" id="complemento" placeholder="Complemento:"></input>

            <input type="text" name="bairro" id="bairro" placeholder="bairro:" required></input>

            <input type="text" name="cep" id="cep" placeholder="CEP:"></input>

            <input type="text" name="localidade" id="localidade" placeholder="Cidade:"></input>

            <input type="text" name="uf" id="uf" placeholder="Estado:"></input>
           
            <input type="submit" name="enviar" class="enviar acao" value="Salvar"></input>
            <input type="button" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?= $this->Html->script('adicionarCliente') ?>