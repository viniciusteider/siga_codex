<?php
include("modulos/produtos_sub_grupo/template/js.produtos_sub_grupo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Sub Grupo";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Produtos Sub Grupo";
$configModulo['id_card'] = "conteudo_produtos_sub_grupo";
echo $objApp->GerarCardContainer($configModulo);
