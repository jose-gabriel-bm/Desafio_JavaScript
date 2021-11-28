
<div>
    <form  id="formulario">

        <fieldset>

            <h2>Dados Pessoais</h2>
            <label id="nome">Nome:<label>
            <input type="text" id="nome" placeholder="Nome" required></input>

            <label id="cpf">CPF:</label>
            <input type="text" id="cpf" placeholder="CPF" required ></input>

            <label id="email">Email (opcional):</label>
		    <input type="email" name="email" id="email" placeholder="Email:exemplo@email.com" ></input>

            <input type="submit" name="proximo" class="proximo acao" value="Proximo" /></input>

        </fieldset>
        <fieldset>
            <h2>Contato</h2>
            <label id="codigo_pais">Codigo do pais:<label>
            <input type="text" id="codigo_pais" placeholder="55" default="55"></input>

            <label id="ddd">DDD:<label>
            <input type="text" id="ddd" placeholder="62" default="62"></input>

            <label id="numero">Numero:<label>
            <input type="text" id="numero" placeholder="9 0000-0000" required ></input>

            <input type="submit" name="anterior" class="anterior acao" value="Anterior" /></input>
            <input type="submit" name="proximo" class="proximo acao" value="Proximo" /></input>

        </fieldset>
        <fieldset>
            <h2>Endereço</h2>
            <label id="logradouro">Logradouro:<label>
            <input type="text" id="logradouro" placeholder="Rua ,Lote ,Quadra " required></input>

            <label id="numeroCasa">numero:<label>
            <input type="text" id="numeroCasa" placeholder="Numero da casa"></input>

            <label id="complemento">Complemento:<label>
            <input type="text" id="complemento" placeholder="Caso tenha complemento"></input>

            <label id="bairro">Bairro:<label>
            <input type="text" id="bairro" required></input>

            <label id="cep">CEP:<label>
            <input type="text" id="cep"></input>

            <label id="cidade">Cidade:<label>
            <input type="text" id="cidade"></input>

            <input type="submit" name="anterior" class="anterior acao" value="Anterior" /></input>
            <input type="submit" name="enviar" class="enviar" value="Salvar" /></input>

        </fieldset>
        
    </form>
</div>
