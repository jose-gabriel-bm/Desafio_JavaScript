<div class="mensagem"></div>

<div>
    <form  id="formulario" method="POST" enctype="multipart/form-data" name="formulario">

        <ul id="progress">
            <li class="ativo">Dados Pessoais</li>
            <li>Contato</li>
            <li>Endereco</li>
        </ul>

        <fieldset>

            <h2>Dados Pessoais</h2>
            
            <input type="text" name="nome" id="nome" placeholder="Nome"></input>

            <input type="text" name="cpf" id="cpf" placeholder="CPF"></input>
  
		    <input type="email" name="email" id="email" placeholder="Email" ></input>

            <input type="button" name="next1" class="next acao" value="Proximo" /></input>

        </fieldset>
        <fieldset>

            <h2>Contato</h2>

            <input type="text" name="codigo_pais" id="codigo_pais" placeholder="Codigo do pais: 55" default="55"></input>

            <input type="text" name="ddd" id="ddd" placeholder="DDD: 62" default="62"></input>

            <input type="text" name="numero" id="numero" placeholder="Numero: 0000-0000" required ></input>
            
            <div class="contato"></div>
            
            <input type="button" name="addContato" class="addContato" value="Adicionar +1 contato" /></input>

            <input type="button" name="next2" class="next acao" value="Proximo" /></input>
            <input type="button" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
        <fieldset>
            <h2>Endereço</h2>

            <input type="text" id="logradouro" placeholder="Logradouro:Rua ,Lote ,Quadra " required></input>

            <input type="text" id="numeroCasa" placeholder="Numero:"></input>

            <input type="text" id="complemento" placeholder="Complemento:"></input>

            <input type="text" id="bairro" placeholder="bairro:" required></input>

            <input type="text" id="cep" placeholder="CEP:"></input>

            <input type="text" id="cidade" placeholder="Cidade:"></input>
           
            <input type="submit" name="enviar" class="enviar acao" value="Salvar" /></input>
            <input type="button" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?= $this->Html->script('adicionarCliente') ?>