<?php
include("modulos/produtos_modelo/template/js.produtos_modelo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Modelo";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Modelo";
$configModulo['id_card'] = "conteudo_produtos_modelo";
echo $objApp->GerarCardContainer($configModulo);
