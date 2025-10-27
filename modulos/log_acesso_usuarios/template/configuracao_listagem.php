<!--Script das configurações dos relatórios-->
<script src="js/ConfiguracaoRelatorios.js"></script>
<?
$grid                     = new GerarGrid();
$objConfiguracaoModulos   = new ConfiguracaoModulos();
$dados_coluna["dados_th"] = $objConfiguracaoModulos->GerarTemplateConfiguracao("log_acesso_usuarios");
$grid->colunas            = $dados_coluna;
echo $grid->GerarConfiguracoes($_SESSION["configuracao_usuario"]["log_acesso_usuarios"], $_REQUEST["limite_colunas"]);
