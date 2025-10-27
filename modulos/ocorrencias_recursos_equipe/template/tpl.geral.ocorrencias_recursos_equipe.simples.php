<?php 
	include("modulos/ocorrencias_recursos_equipe/template/js.ocorrencias_recursos_equipe.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrencias Recursos Equipe";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ocorrencias_recursos_equipe/template/tpl.modal.ocorrencias_recursos_equipe.php");
$configModulo['titulo_card'] = "Listagem Ocorrencias Recursos Equipe";
$configModulo['id_card'] = "conteudo_ocorrencias_recursos_equipe";
echo $objApp->GerarCardContainer($configModulo);
