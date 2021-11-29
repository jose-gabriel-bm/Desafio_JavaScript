
<div>
    <form  id="formulario">

        <ul id="progress">
            <li class="ativo">Dados Pessoais</li>
            <li>Contato</li>
            <li>Endereco</li>
        </ul>

        <fieldset>

            <h2>Dados Pessoais</h2>
            
            <input type="text" id="nome" placeholder="Nome" required></input>

            <input type="text" id="cpf" placeholder="CPF" required ></input>
  
		    <input type="email" name="email" id="email" placeholder="Email" ></input>

            <input type="submit" name="next" class="next acao" value="Proximo" /></input>

        </fieldset>
        <fieldset>

            <h2>Contato</h2>

            <input type="text" id="codigo_pais" placeholder="Codigo do pais: 55" default="55"></input>

            <input type="text" id="ddd" placeholder="DDD: 62" default="62"></input>

            <input type="text" id="numero" placeholder="Numero: 9 0000-0000" required ></input>
     
            <input type="submit" name="next" class="next acao" value="Proximo" /></input>
            <input type="submit" name="prev" class="prev acao" value="Anterior" /></input>

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
            <input type="submit" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?= $this->Html->script('adicionarCliente') ?>