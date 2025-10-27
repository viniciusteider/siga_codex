<?php
include("modulos/produtos_marca/template/js.produtos_marca.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Marca";
echo $objApp->GerarBreadCrumb($configTitulo);

$configModulo['titulo_card'] = "Listagem Produtos Marca";
$configModulo['id_card'] = "conteudo_produtos_marca";
echo $objApp->GerarCardContainer($configModulo);
