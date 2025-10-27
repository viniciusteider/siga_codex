<?php 
	include("modulos/recursos_cores/template/js.recursos_cores.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Recursos Cores";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Recursos Cores";
$configModulo['id_card'] = "conteudo_recursos_cores";
echo $objApp->GerarCardContainer($configModulo);
