<?php
$objlog = new LogAcessoUsuarios();
$objlog->setId($_REQUEST['app_codigo']);
$linha = $objlog->Editar();

//Conexao::pr($linha);

$dados = json_decode($linha['dados']);

Conexao::pr($dados);