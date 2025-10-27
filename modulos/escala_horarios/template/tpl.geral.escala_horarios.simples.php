<?php 
	include("modulos/escala_horarios/template/js.escala_horarios.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Horarios";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_horarios/template/tpl.modal.escala_horarios.php");
$configModulo['titulo_card'] = "Listagem Escala Horarios";
$configModulo['id_card'] = "conteudo_escala_horarios";
echo $objApp->GerarCardContainer($configModulo);
