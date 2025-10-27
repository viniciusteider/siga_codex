<!--Script das configurações dos relatórios-->
<script src="js/ConfiguracaoRelatorios.js"></script>
<?php
$grid                     = new GerarGrid();
$objConfiguracaoModulos   = new ConfiguracaoModulos();
$dados_coluna["dados_th"] = $objConfiguracaoModulos->GerarTemplateConfiguracao("almoxarifado");
$grid->colunas            = $dados_coluna;
echo $grid->GerarConfiguracoes($_SESSION["configuracao_usuario"]["almoxarifado"], $_REQUEST["limite_colunas"]);
