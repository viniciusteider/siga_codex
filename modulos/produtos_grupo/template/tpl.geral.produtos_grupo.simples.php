<?php
include("modulos/produtos_grupo/template/js.produtos_grupo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Grupo";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Grupo";
$configModulo['id_card'] = "conteudo_produtos_grupo";
echo $objApp->GerarCardContainer($configModulo);
