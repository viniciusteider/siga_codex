<?php
include("modulos/pessoal_ferias/template/js.pessoal_ferias.php");
$objApp = new App();

include("modulos/pessoal_ferias/template/tpl.modal.pessoal_ferias.php");
$configModulo['titulo_card'] = "Listagem de Férias";
$configModulo['id_card'] = "conteudo_pessoal_ferias";
echo $objApp->GerarCardContainer($configModulo);
