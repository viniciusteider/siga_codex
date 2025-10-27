<?php 
	include("modulos/paciente_sinais_clinicos/template/js.paciente_sinais_clinicos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Sinais Clinicos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_sinais_clinicos/template/tpl.modal.paciente_sinais_clinicos.php");
$configModulo['titulo_card'] = "Listagem Paciente Sinais Clinicos";
$configModulo['id_card'] = "conteudo_paciente_sinais_clinicos";
echo $objApp->GerarCardContainer($configModulo);
