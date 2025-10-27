<?php 
	include("modulos/escala_equipe_horarios/template/js.escala_equipe_horarios.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Equipe Horarios";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_equipe_horarios/template/tpl.modal.escala_equipe_horarios.php");
$configModulo['titulo_card'] = "Listagem Escala Equipe Horarios";
$configModulo['id_card'] = "conteudo_escala_equipe_horarios";
echo $objApp->GerarCardContainer($configModulo);
