<?php
include("modulos/pessoal_curso/template/js.pessoal_curso.php");
$objApp = new App();
include("modulos/pessoal_curso/template/tpl.modal.pessoal_curso.php");
$configModulo['titulo_card'] = "Listagem de Cursos";
$configModulo['id_card'] = "conteudo_pessoal_curso";
echo $objApp->GerarCardContainer($configModulo);
