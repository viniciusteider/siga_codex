<?php 
	include("modulos/paciente_sinais_clinicos_obstetricia/template/js.paciente_sinais_clinicos_obstetricia.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Sinais Clinicos Obstetricia";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_sinais_clinicos_obstetricia/template/tpl.modal.paciente_sinais_clinicos_obstetricia.php");
$configModulo['titulo_card'] = "Listagem Paciente Sinais Clinicos Obstetricia";
$configModulo['id_card'] = "conteudo_paciente_sinais_clinicos_obstetricia";
echo $objApp->GerarCardContainer($configModulo);
