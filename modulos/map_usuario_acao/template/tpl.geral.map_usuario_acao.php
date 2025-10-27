<?php 
include("modulos/map_usuario_acao/template/js.map_usuario_acao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Map Usuario Acao";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Map Usuario Acao";
$configModulo['id_card'] = "conteudo_map_usuario_acao";
echo $objApp->GerarCardContainer($configModulo);
