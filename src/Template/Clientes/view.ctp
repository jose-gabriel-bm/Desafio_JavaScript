<div class="view">
    
   <h3><?php echo $cliente->nome;  ?></h3>
    <table >
    <div>
            <label>
                <h5><b>Dados pessoais</b></h5>
            </label>
            <tr>
                <td>CPF: </td>
                <td><?php echo $cliente->cpf; ?></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><?php echo $cliente->email; ?></td>
            </tr>
            <tr> 
                <td>Status: </td>
                <td><?php echo $cliente->opcoes_status; ?></td>
            </tr>
    </div>
    </table>
        <label>
            <h5><b>Contatos</b></h5>
        </label>
        
    <table>
        <thead>
            <tr>
                <th>Codigo Pais</th>
                <th>DDD</th>
                <th>Numero</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cliente->contatos as $contato ) : ?>
                <tr>
                    <td style="text-align:center;"><?php echo $contato['codigo_pais']; ?></td>
                    <td style="text-align:center;"><?php echo $contato['ddd']; ?></td>
                    <td style="text-align:center;"><?php echo $contato['numero']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <label>
            <h5><b>Endereço</b></h5>
        </label>    
    <table>
        <thead>
            <tr>
                <th>Logradouro</th>
                <th>Numero</th>
                <th>Bairro</th>
                <th>Cep</th>
                <th>Complemento</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($cliente->enderecos as $endereco ) : ?>
                <tr>
                    <td><?php echo $endereco['logradouro']; ?></td>
                    <td><?php echo $endereco['numero']; ?></td>
                    <td><?php echo $endereco['bairro']; ?></td>
                    <td><?php echo $endereco['cep']; ?></td>
                    <td><?php echo $endereco['complemento']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?PHP echo $this->Html->link(__('Voltar  '), ['controller' => 'Clientes','action' =>'index']);?>
</div>
