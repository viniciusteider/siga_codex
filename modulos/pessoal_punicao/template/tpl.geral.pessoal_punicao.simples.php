<?php
include("modulos/pessoal_punicao/template/js.pessoal_punicao.php");
$objApp = new App();
include("modulos/pessoal_punicao/template/tpl.modal.pessoal_punicao.php");
$configModulo['titulo_card'] = "Listagem de Punições";
$configModulo['id_card'] = "conteudo_pessoal_punicao";
echo $objApp->GerarCardContainer($configModulo);
