<?php
include("modulos/produtos_cor/template/js.produtos_cor.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Cor";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Cor";
$configModulo['id_card'] = "conteudo_produtos_cor";
echo $objApp->GerarCardContainer($configModulo);
