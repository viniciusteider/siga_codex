<?php 
	include("modulos/pessoal_atestado/template/js.pessoal_atestado.php");
$objApp = new App();
include("modulos/pessoal_atestado/template/tpl.modal.pessoal_atestado.php");
$configModulo['titulo_card'] = "Atestados";
$configModulo['id_card'] = "conteudo_pessoal_atestado";
echo $objApp->GerarCardContainer($configModulo);
