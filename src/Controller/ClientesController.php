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

        $this->loadModel('Estados');
        $this->loadModel('Contatos');
        $this->loadModel('Enderecos');

        $estados = $this->Estados->find();
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
        $this->set(compact('estados'));

    }

    public function view($id)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Enderecos', 'Contatos']
        ]);
        $this->set(compact('cliente'));
    }
    public function edit($id = null)
    {
        $this->loadModel('Enderecos');
        $this->loadModel('Contatos');
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Enderecos', 'Contatos'],
        ]);
        $id_endereco = $cliente->enderecos[0]->id;
        $endereco = $this->Enderecos->get($id_endereco);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $dados = $this->request->getData();

            $cliente->set([
                'nome' => $dados['dados']['dadosPessoais']['nome'],
                'cpf' => $dados['dados']['dadosPessoais']['cpf'],
                'email' => $dados['dados']['dadosPessoais']['email'],
                'status' => $dados['dados']['dadosPessoais']['status']
            ]);

          if ($this->Clientes->save($cliente)) {
            $endereco->set([
                'cep' => str_replace("-", "", $dados['dados']['endereco']['cep']),
                'logradouro' => $dados['dados']['endereco']['logradouro'],
                'numero' => $dados['dados']['endereco']['numero'],
                'bairro' => $dados['dados']['endereco']['bairro'],
                'complemento' => $dados['dados']['endereco']['complemento']
            ]);

            if ($this->Enderecos->save($endereco)) {

                $idContatos = [];

                foreach ($cliente->contatos as $contato){
                   $idContatos[] = $contato->id;
                }
                if($idContatos){
                    $this->Contatos->deleteAll(['id IN' => $idContatos]);
                }

               $entityContatos = [];
               foreach ($dados['dados']['contatos']['array'] as $contato) {
                   array_push($entityContatos, [
                       'id_cliente' => $id,
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

            }

          }else{
            
            $resultados = $cliente->getErrors();
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

        $this->set('cliente', $cliente);

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
    public function mudarStatus($id = null)
    {
        if ($this->request->allowMethod(['patch', 'post', 'put'])) {

        $cliente = $this->Clientes->get($id);

        if($cliente['status'] == true){
            $cliente->set([
                'status' => 0
            ]);
        }else{
            $cliente->set([
                'status' => 1
            ]);
        }
        $this->Clientes->save($cliente);
        return $this->redirect(['action' => 'index']);
        }
    }
    public function selecionarcidade(){
        if ($this->request->is(['patch', 'post', 'put'])) {

            $id_estado = $this->request->getData();
            $teste = json_decode($id_estado['idEstado']);

            $this->loadModel('Cidades');
            $cidades = $this->Cidades->find();
            $cidades = $cidades->where(['id_estado =' =>$teste]);

            return $this->response->withType("application/json")->withStringBody(json_encode($cidades));
        }         
    }
