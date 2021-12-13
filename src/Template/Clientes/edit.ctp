<div class="mensagem" id="mensagem"></div>
<div id="divEdit">
<h2><?php echo $cliente['nome']?></h2>

    <form id="edit" method="post">

        <fieldset id="dadosPessoais">

            <h3>Dados Pessoais</h3>
            
            <input type="text" id="nome" value="<?php echo $cliente['nome']?>" ></input>
            <input type="text" id="cpf" value="<?php echo $cliente['cpf']?>"></input>
		    <input type="email" id="email" value="<?php echo $cliente['email']?>"></input>
            
            <select id="status">
                <?php if($cliente['status'] == 'true'): ?>
                    <option value="1" <?php echo 'selected'?>>Ativo</option>
                    <option value="0">Inativo</option>
                <?php else:?>
                    <option value="0" <?php echo 'selected'?>>Inativo</option>
                    <option value="1">Ativo</option>
                <?php endif?>
            </select>


        </fieldset>
        <fieldset>

            <h3>Contato</h3>
            <?php $contador = 1;?>
            <?php foreach ($cliente->contatos as $contato ) : ?>
            <div id ='contato<?= $contador ?>'>
                <input type="button" class="apagarContato" id ='contato<?= $contador ?>' value="X" ></input>
                <input type="text" class="contatoEdit" name="codigo_pais" placeholder="Codigo do pais: 55" value="<?php echo $contato['codigo_pais']?>"></input>
                <input type="text" class="contatoEdit" name="ddd" placeholder="DDD: 62" value="<?php echo $contato['ddd']?>"></input>
                <input type="text" class="contatoEdit" name="numero" placeholder="Numero: 0000-0000" value="<?php echo $contato['numero']?>"></input>
                <br>
            </div>
            <?php $contador = $contador + 1;?>
            <?php endforeach; ?>

        </fieldset>
        <fieldset>
            <h3>Endereço</h3>

            <input type="text" value="<?php echo $cliente['enderecos']['0']['cep']?>" id="cep"  placeholder="CEP:"></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['logradouro']?>" id="logradouro" placeholder="Logradouro:Rua ,Lote ,Quadra " ></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['bairro']?>" id="bairro" placeholder="bairro:" ></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['numero']?>" id="nCasa" placeholder="Numero:"></input>
            <input type="text" value="<?php echo $cliente['enderecos']['0']['complemento']?>" id="complemento" placeholder="Complemento:"></input>

            <input type="button" id="btnenviar" class="enviar acao" value="Salvar" onclick="salvarDados()"></input>

        </fieldset>
    </form>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?= $this->Html->script('editarCliente') ?>