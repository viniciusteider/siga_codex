<?php 
	include("modulos/equipes_efetivo/template/js.equipes_efetivo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Equipes Efetivo";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/equipes_efetivo/template/tpl.modal.equipes_efetivo.php");
$configModulo['titulo_card'] = "Listagem Equipes Efetivo";
$configModulo['id_card'] = "conteudo_equipes_efetivo";
echo $objApp->GerarCardContainer($configModulo);
