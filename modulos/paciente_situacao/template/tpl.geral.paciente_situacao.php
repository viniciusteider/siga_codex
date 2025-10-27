<?php 
	include("modulos/paciente_situacao/template/js.paciente_situacao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente Situações";
echo $objApp->GerarBreadCrumb($configTitulo);

$configModulo['titulo_card'] = "Listagem Paciente Situações";
$configModulo['id_card'] = "conteudo_paciente_situacao";
echo $objApp->GerarCardContainer($configModulo);
