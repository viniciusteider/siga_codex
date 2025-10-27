<?php 
	include("modulos/uniforme_peca/template/js.uniforme_peca.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Uniformes Peças";
echo $objApp->GerarBreadCrumb($configTitulo);

	include("modulos/uniforme_peca/template/tpl.modal.uniforme_peca.php");
$configModulo['titulo_card'] = "Listagem Uniformes Peças";
$configModulo['id_card'] = "conteudo_uniforme_peca";
echo $objApp->GerarCardContainer($configModulo);
