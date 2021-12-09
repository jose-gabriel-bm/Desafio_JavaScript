<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ClientesController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Clientes.id' => 'Desc',
            ]
        ];

        $busca =  $this->request->query();
        $this->buscaIndex($busca);
    }
    public function adicionar()
    {
        $this->loadModel('Contatos');
        $this->loadModel('Enderecos');
        $entityDadosPessoais = $this->Clientes->newEntity();
        $entityEndereco = $this->Enderecos->newEntity();

        if ($this->request->is('post')) {

            $dados = $this->request->getData();

            $entityDadosPessoais->nome = $dados['dados']['dadosPessoais']['nome'];
            $entityDadosPessoais->cpf = $dados['dados']['dadosPessoais']['cpf'];
            $entityDadosPessoais->email = $dados['dados']['dadosPessoais']['email'];

                $idCliente = null;
            if ($this->Clientes->save($entityDadosPessoais)) {
                $idCliente = $entityDadosPessoais->id;

                $entityEndereco->id_cliente = $idCliente;
                $entityEndereco->id_cidade = 1;
                $entityEndereco->logradouro = $dados['dados']['endereco']['logradouro'];
                $entityEndereco->numero = $dados['dados']['endereco']['nCasa'];
                $entityEndereco->complemento = $dados['dados']['endereco']['complemento'];
                $entityEndereco->bairro = $dados['dados']['endereco']['bairro'];
                $entityEndereco->cep = str_replace('-', '', $dados['dados']['endereco']['cep']);

                if ($this->Enderecos->save($entityEndereco)) {

                    $entityContatos = [];
                    foreach ($dados['dados']['contatos']['array'] as $contato) {
                        array_push($entityContatos, [
                            'id_cliente' => $idCliente,
                            'codigo_pais' => $contato['codigo_pais'],
                            'ddd' => $contato['ddd'],
                            'numero' => $contato['numero']
                        ]);
                    }

                    $contatos = TableRegistry::getTableLocator()->get('Contatos');
                    $entities = $contatos->newEntities($entityContatos);

                    foreach ($entities as $entity) {
                        $contatos->save($entity);
                    }

                } else {
                    
                    // $resposta['erro'] =
                    return $this->response->withType("application/json")->withStringBody(json_encode(['resultado' => $entityEndereco->getErrors()]));
                }
            } else { 
                $resultados = $entityDadosPessoais->getErrors();
                foreach($resultados as $key =>$resultado){
                    $erro['chave'] = $key;
                    foreach($resultado as $resultad){
                        $erro['mensagem'] = $resultad;
                    }
                }
                $erro['sucesso'] = false;
            return $this->response->withType("application/json")->withStringBody(json_encode($erro));
            }
            
        }
    }

    public function view($id)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Enderecos', 'Contatos']
        ]);
        $this->set(compact('cliente'));
    }

    public function buscaIndex($busca)
    {
        if (isset($busca)) {

            $clientes = $this->Clientes->find('all');

            if (isset($busca['nome'])) {
                $clientes = $clientes->where(['nome LIKE' => "%$busca[nome]%"]);
            }
            if (isset($busca['cpf'])) {
                $clientes = $clientes->where(['cpf LIKE' => "%$busca[cpf]%"]);
            }
            if (isset($busca['email'])) {
                $clientes = $clientes->where(['email LIKE' => "%$busca[email]%"]);
            }
            if (isset($busca['status'])) {
                if ($busca['status'] == 'Ativo') :
                    $clientes = $clientes->where(['status =' => 1]);
                endif;
                if ($busca['status'] == 'Inativo') :
                    $clientes = $clientes->where(['status =' => 0]);
                endif;
            }
        } else {
            $clientes = $this->Clientes->find('all');
        }
        $clientes = $this->paginate($clientes);
        $this->set(compact('clientes'));
    }
}
