
<?php
	include("modulos/paciente/template/js.paciente.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/paciente/template/tpl.modal.paciente.php");
$configModulo['titulo_card'] = "Listagem Paciente";
$configModulo['id_card'] = "conteudo_paciente";
echo $objApp->GerarCardContainer($configModulo);
