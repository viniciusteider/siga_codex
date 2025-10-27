<!--Script das configurações dos relatórios-->
<script src="js/ConfiguracaoRelatorios.js"></script>
<?php
$grid                     = new GerarGrid();
$objConfiguracaoModulos   = new ConfiguracaoModulos();
$dados_coluna["dados_th"] = $objConfiguracaoModulos->GerarTemplateConfiguracao("escala_flex");
$grid->colunas            = $dados_coluna;
echo $grid->GerarConfiguracoes($_SESSION["configuracao_usuario"]["escala_flex"], $_REQUEST["limite_colunas"]);
