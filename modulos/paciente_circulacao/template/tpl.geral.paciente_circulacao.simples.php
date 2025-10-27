<?php 
	include("modulos/paciente_circulacao/template/js.paciente_circulacao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Circulacao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente_circulacao/template/tpl.modal.paciente_circulacao.php");
$configModulo['titulo_card'] = "Listagem Paciente Circulacao";
$configModulo['id_card'] = "conteudo_paciente_circulacao";
echo $objApp->GerarCardContainer($configModulo);
