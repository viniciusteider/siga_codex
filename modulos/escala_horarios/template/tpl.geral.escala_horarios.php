<?php
include("modulos/escala_horarios/template/js.escala_horarios.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Horários";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Escala Horários";
$configModulo['id_card'] = "conteudo_escala_horarios";
echo $objApp->GerarCardContainer($configModulo);
