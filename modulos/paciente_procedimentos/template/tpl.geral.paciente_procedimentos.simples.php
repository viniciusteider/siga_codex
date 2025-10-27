<?php 
	include("modulos/paciente_procedimentos/template/js.paciente_procedimentos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Procedimentos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_procedimentos/template/tpl.modal.paciente_procedimentos.php");
$configModulo['titulo_card'] = "Listagem Paciente Procedimentos";
$configModulo['id_card'] = "conteudo_paciente_procedimentos";
echo $objApp->GerarCardContainer($configModulo);
