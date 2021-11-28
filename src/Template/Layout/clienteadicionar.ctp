<?php

$cakeDescription = 'Adicionar';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
    <?= $this->fetch('title') ?>:
    <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css('adicionarCliente') ?>
    <?= $this->Html->css('bootstrap.min') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="collapse navbar-collapse">
           <nav>
               <ul class="navbar-nav navbar-left">
                   <li>
                      <a href="https://book.cakephp.org/3/">Documentação</a>
                   </li>
                   <li>
                      <a href="https://api.cakephp.org/3.0/">API</a>
                   </li>
               </ul> 
           </nav>               
        </div>
    </nav>

    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
