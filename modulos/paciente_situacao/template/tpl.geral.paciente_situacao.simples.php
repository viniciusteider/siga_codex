<?php 
	include("modulos/paciente_situacao/template/js.paciente_situacao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Situacao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_situacao/template/tpl.modal.paciente_situacao.php");
$configModulo['titulo_card'] = "Listagem Paciente Situacao";
$configModulo['id_card'] = "conteudo_paciente_situacao";
echo $objApp->GerarCardContainer($configModulo);
