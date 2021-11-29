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
<body style="background-color: #F0F8FF;">
    
    <nav id="menu">
    <ul>
        <li><a href="#">Cliente</a></li>
        <li><a href="https://book.cakephp.org/3/">Documentação</a></li>
        <li><a href="https://api.cakephp.org/3.0/">API</a></li>
    </ul>
</nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
