<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
    }
    public function beforeRender(Event $event)
    {
        $action = null;

        if($this->request->getParam(['action']) !== null){

           $action = $this->request->getParam(['action']);

            if($action == 'adicionar'){
                $this->viewBuilder()->setLayout('clienteadicionar');
            }
        }
    }
}
