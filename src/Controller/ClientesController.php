<?php
namespace App\Controller;

use App\Controller\AppController;
use PhpParser\Node\Stmt\Echo_;

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

            foreach($campo_post as  $indice => $valor){
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
            $entityDadoscontato = $this->Contatos->newEntity([
                'id_cliente' => $idCliente,
                'ddd' => $novos_campos['ddd'],
                'codigo_pais' => $novos_campos['codigo_pais'],
                'numero' => $novos_campos['numero'],
            ]);

            if ($this->Clientes->save($entityDadoscontato)) {
            } 
        
            
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