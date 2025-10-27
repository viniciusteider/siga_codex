<?php
include("modulos/produtos_tamanho/template/js.produtos_tamanho.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Tamanho";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Tamanho";
$configModulo['id_card'] = "conteudo_produtos_tamanho";
echo $objApp->GerarCardContainer($configModulo);
