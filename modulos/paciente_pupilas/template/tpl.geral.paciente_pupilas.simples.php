<?php 
	include("modulos/paciente_pupilas/template/js.paciente_pupilas.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Pupilas";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_pupilas/template/tpl.modal.paciente_pupilas.php");
$configModulo['titulo_card'] = "Listagem Paciente Pupilas";
$configModulo['id_card'] = "conteudo_paciente_pupilas";
echo $objApp->GerarCardContainer($configModulo);
