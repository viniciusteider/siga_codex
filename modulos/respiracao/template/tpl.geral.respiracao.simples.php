<?php 
	include("modulos/respiracao/template/js.respiracao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Respiracao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/respiracao/template/tpl.modal.respiracao.php");
$configModulo['titulo_card'] = "Listagem Respiracao";
$configModulo['id_card'] = "conteudo_respiracao";
echo $objApp->GerarCardContainer($configModulo);
