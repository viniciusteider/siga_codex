<?php
include("modulos/produtos_revestimento/template/js.produtos_revestimento.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Revestimento";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Revestimento";
$configModulo['id_card'] = "conteudo_produtos_revestimento";
echo $objApp->GerarCardContainer($configModulo);
