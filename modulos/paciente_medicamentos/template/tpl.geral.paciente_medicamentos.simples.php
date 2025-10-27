<?php 
	include("modulos/paciente_medicamentos/template/js.paciente_medicamentos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Medicamentos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_medicamentos/template/tpl.modal.paciente_medicamentos.php");
$configModulo['titulo_card'] = "Listagem Paciente Medicamentos";
$configModulo['id_card'] = "conteudo_paciente_medicamentos";
echo $objApp->GerarCardContainer($configModulo);
