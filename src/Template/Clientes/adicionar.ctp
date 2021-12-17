<div class="mensagem" id="mensagem"></div>

<div>    <form id="formulario" name="formulario">

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

            <input type="text" class="endereco" name="cep" id="cep" placeholder="CEP:"></input>

            <select name="estado" id="estado" onchange="selecionarCidades()">
                <option value="" disabled selected>Estado</option>
                <?php foreach($estados as $estado):?>
                   <option value="<?= $estado->id?>" id="<?= $estado->uf?>"><?= $estado->uf?></option>
                <?php endforeach;?>
            </select>

            <select name="cidade" id="cidade" >
                <option value="" disabled selected>Cidade</option>
            </select>

            <input type="text" class="endereco" name="logradouro" id="logradouro" placeholder="Logradouro:Rua ,Lote ,Quadra " required></input>
            <input type="text" class="endereco" name="bairro" id="bairro" placeholder="bairro:" required></input>
            <input type="text" class="endereco" name="nCasa" id="nCasa" placeholder="Numero:"></input>
            <input type="text" class="endereco" name="complemento" id="complemento" placeholder="Complemento:"></input>

            <input type="submit" name="enviar" class="enviar acao" value="Salvar"></input>
            <input type="button" name="prev" class="prev acao" value="Anterior" /></input>

        </fieldset>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?= $this->Html->script('adicionarCliente') ?>