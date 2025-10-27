<!--Script das configurações dos relatórios-->
<script src="js/ConfiguracaoRelatorios.js"></script>
<?php
$grid                     = new GerarGrid();
$objConfiguracaoModulos   = new ConfiguracaoModulos();
$dados_coluna["dados_th"] = $objConfiguracaoModulos->GerarTemplateConfiguracao("pupilas_sintomas");
$grid->colunas            = $dados_coluna;
echo $grid->GerarConfiguracoes($_SESSION["configuracao_usuario"]["pupilas_sintomas"], $_REQUEST["limite_colunas"]);
