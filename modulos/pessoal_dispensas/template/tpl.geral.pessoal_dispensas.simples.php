<?php
include("modulos/pessoal_dispensas/template/js.pessoal_dispensas.php");
$objApp = new App();
include("modulos/pessoal_dispensas/template/tpl.modal.pessoal_dispensas.php");
$configModulo['titulo_card'] = "Listagem de Dispensas";
$configModulo['id_card'] = "conteudo_pessoal_dispensas";
echo $objApp->GerarCardContainer($configModulo);
