<?php 
	include("modulos/classificacao_ligacao/template/js.classificacao_ligacao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Classificação de Ligação";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/classificacao_ligacao/template/tpl.modal.classificacao_ligacao.php");
$configModulo['titulo_card'] = "Listagem Classificação de Ligação";
$configModulo['id_card'] = "conteudo_classificacao_ligacao";
echo $objApp->GerarCardContainer($configModulo);
