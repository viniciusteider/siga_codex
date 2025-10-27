<?php 
	include("modulos/paciente_sinais_vitais/template/js.paciente_sinais_vitais.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Sinais Vitais";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_sinais_vitais/template/tpl.modal.paciente_sinais_vitais.php");
$configModulo['titulo_card'] = "Listagem Paciente Sinais Vitais";
$configModulo['id_card'] = "conteudo_paciente_sinais_vitais";
echo $objApp->GerarCardContainer($configModulo);
