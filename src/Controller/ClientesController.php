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
                'Clientes.id' => 'Desc',]
            ];
    
            $busca =  $this->request->query();
            $this->buscaIndex($busca);
       
    }
    public function adicionar()
    {
        
        if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'sim'):

            $novos_campos = array();
            $campo_post = $_POST['campos'];

            foreach($campo_post as $valor){
                $novos_campos[$valor['name']] = $valor['value'];
            }              

            $entityDadosPessoais = $this->Clientes->newEntity([
                'nome' => $novos_campos['nome'],
                'cpf' => $novos_campos['cpf'],
                'email' => $novos_campos['email'],
                'status' => '1',
            ]);

            $idCliente = null;
            if ($this->Clientes->save($entityDadosPessoais)) {
                $idCliente = $entityDadosPessoais->id;
            } 

            $this->loadModel('Contatos');

            $contato = [];
            foreach($novos_campos as $key => $valor){               

                if(strpos($key, 'numero') !== false ){

                    $subject = $key;
                    $search = 'numero' ;
                    $trimmed = str_replace($search, '', $subject);

                    array_push($contato,[
                        'id_cliente' => $idCliente,
                        'numero' => $valor,
                        'ddd' => $novos_campos['ddd'.$trimmed],
                        'codigo_pais' => $novos_campos['codigo_pais'.$trimmed],
                        'principal' => $novos_campos['principal'.$trimmed],
                        'whatsapp' => $novos_campos['whatsapp'.$trimmed],
                    ]);
                }
                
            } 
            $contatos = TableRegistry::get('Contatos'); 

            foreach($contato as $contat){
                $contatos->save($contat);
            }

            // $this->loadModel('Enderecos');

            // $entityEndereco = $this->Clientes->newEntity([
            //     'nome' => $novos_campos['nome'],
            //     'cpf' => $novos_campos['cpf'],
            //     'email' => $novos_campos['email'],
            //     'status' => $novos_campos['email'],
            //     'nome' => $novos_campos['nome'],
            //     'cpf' => $novos_campos['cpf'],
            //     'email' => $novos_campos['email'],
            //     'status' => $novos_campos['email'],
            // ]);


            // if ($this->Clientes->save($entityEndereco)) {
            //     $this->Flash->success('Contatos salvos com sucesso');
            // }else{
            //     $this->Flash->error('Nao foi possivel salvar contatos');
            // }      
            
        endif;

    }

    public function buscaIndex($busca)
    {
        if (isset($busca)) 
        {

            $clientes = $this->Clientes->find('all');

            if(isset($busca['nome'])){   
                $clientes = $clientes->where(['nome LIKE' => "%$busca[nome]%"]); 
            }
            if(isset($busca['cpf'])){  
                $clientes = $clientes->where(['cpf LIKE' => "%$busca[cpf]%"]);   
            }
            if(isset($busca['email'])){    
                $clientes = $clientes->where(['email LIKE' => "%$busca[email]%"]); 
            }
            if(isset($busca['status'])){
                if($busca['status'] == 'Ativo'):
                    $clientes = $clientes->where(['status =' => 1]);
                endif;
                if($busca['status'] == 'Inativo'):
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