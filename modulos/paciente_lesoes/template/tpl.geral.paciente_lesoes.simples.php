<?php 
	include("modulos/paciente_lesoes/template/js.paciente_lesoes.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Lesoes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_lesoes/template/tpl.modal.paciente_lesoes.php");
$configModulo['titulo_card'] = "Listagem Paciente Lesoes";
$configModulo['id_card'] = "conteudo_paciente_lesoes";
echo $objApp->GerarCardContainer($configModulo);
