<?php
namespace App\Controller;

use App\Controller\AppController;

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