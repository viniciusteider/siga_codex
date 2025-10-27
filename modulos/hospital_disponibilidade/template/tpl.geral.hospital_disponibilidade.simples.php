<?php
include("modulos/hospital_disponibilidade/template/js.hospital_disponibilidade.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Hospital Disponibilidade";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Hospital Disponibilidade";
$configModulo['id_card'] = "conteudo_hospital_disponibilidade";
echo $objApp->GerarCardContainer($configModulo);
