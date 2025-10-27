<?php

// fazendo incluzão de globais e constantes  de configurações do sistema.
include_once("includes/config.inc.php");
// tratamento de tudo que chega por POST E GET E REQUEST
Utils::TratarRequest();

$objAPP = new App();
$objAPP->modulo = $_REQUEST['app_modulo'];
$objAPP->acao = $_REQUEST['app_comando'];
$objAPP->sessao = $_SESSION;
//$objAPP->include_topo = '';
$objAPP->include_body = 'template/body_full.php';
$objAPP->include_footer = 'template/foot_full.php';
$objAPP->ExecutarModulo();

$objLogAcesso = new LogAcesso(1);
$objLogAcesso->Gravar($_REQUEST['app_comando']);
