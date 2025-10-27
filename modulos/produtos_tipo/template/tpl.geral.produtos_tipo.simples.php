<?php
include("modulos/produtos_tipo/template/js.produtos_tipo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Tipo";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Tipo";
$configModulo['id_card'] = "conteudo_produtos_tipo";
echo $objApp->GerarCardContainer($configModulo);
