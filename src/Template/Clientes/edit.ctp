<div id="divEdit">
<h2><?php echo $cliente['nome']?></h2>

    <form id="edit" method="get">

        <fieldset id="dadosPessoais">

            <h3>Dados Pessoais</h3>
            
            <input type="text" name="nome" value="<?php echo $cliente['nome']?>" ></input>
            <input type="text" name="cpf" value="<?php echo $cliente['cpf']?>"></input>
		    <input type="email" name="email" value="<?php echo $cliente['email']?>"></input>
            
            <select name="status">
                <?php if($cliente['status'] == 'true'): ?>
                    <option <?php echo 'selected'?>>Ativo</option>
                    <option>Inativo</option>
                <?php else:?>
                    <option <?php echo 'selected'?>>Inativo</option>
                    <option>Ativo</option>
                <?php endif?>
            </select>


        </fieldset>
        <fieldset>

            <h3>Contato</h3>

            <?php foreach ($cliente->contatos as $contato ) : ?>

            <input type="text" class="contatoEdit" name="codigo_pais" placeholder="Codigo do pais: 55" value="<?php echo $contato['codigo_pais']?>"></input>
            <input type="text" class="contatoEdit" name="ddd" placeholder="DDD: 62" value="<?php echo $contato['ddd']?>"></input>
            <input type="text" class="contatoEdit" name="numero" placeholder="Numero: 0000-0000" value="<?php echo $contato['numero']?>"></input>
            <br>
            <?php endforeach; ?>

        </fieldset>
        <fieldset>
            <h3>Endereço</h3>

            <input type="text" value="<?php echo $cliente['enderecos']['0']['cep']?>" name="cep"  placeholder="CEP:"></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['logradouro']?>" name="logradouro" placeholder="Logradouro:Rua ,Lote ,Quadra " ></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['bairro']?>" name="bairro" placeholder="bairro:" ></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['numero']?>" name="nCasa" placeholder="Numero:"></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['complemento']?>" name="complemento" placeholder="Complemento:"></input>

            <input type="submit" id="btnenviar" class="enviar acao" value="Salvar"></input>

        </fieldset>
    </form>
</div>