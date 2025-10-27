<?php 
	include("modulos/escala_equipe/template/js.escala_equipe.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Equipe";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_equipe/template/tpl.modal.escala_equipe.php");
$configModulo['titulo_card'] = "Listagem Escala Equipe";
$configModulo['id_card'] = "conteudo_escala_equipe";
echo $objApp->GerarCardContainer($configModulo);
