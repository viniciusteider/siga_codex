<!--Script das configurações dos relatórios-->
<script src="js/ConfiguracaoRelatorios.js"></script>
<?php
$grid                     = new SquallTable();
$objConfiguracaoModulos   = new ConfiguracaoModulos();
$dados_coluna["dados_th"] = $objConfiguracaoModulos->GerarTemplateConfiguracao("produtos_saida_estoque");
$grid->colunas            = $dados_coluna;
echo $grid->GerarConfiguracoes($_SESSION["configuracao_usuario"]["produtos_saida_estoque"], $_REQUEST["limite_colunas"]);
