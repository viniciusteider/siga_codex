<?php 
	include("modulos/escala_locais/template/js.escala_locais.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Locais";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_locais/template/tpl.modal.escala_locais.php");
$configModulo['titulo_card'] = "Listagem Escala Locais";
$configModulo['id_card'] = "conteudo_escala_locais";
echo $objApp->GerarCardContainer($configModulo);
