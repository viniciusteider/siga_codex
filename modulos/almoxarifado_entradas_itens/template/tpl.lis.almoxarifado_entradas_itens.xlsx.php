<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens();
$listar = $objAlmoxarifadoEntradasItens->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Quantidade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Valor];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["quantidade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["valor"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["almoxarifado_entradas_itens"]);

$filtro[ROTULO_LISTAGEM] = Almoxarifado_entradas_itens;
//$filtro[ROTULO_RELATORIO] = Almoxarifado_entradas_itens;
if ($_REQUEST["id_grupo"] > 0) {
	$filtro[ROTULO_GRUPO] = $_REQUEST["nome_grupo"];
}
if ($_REQUEST["id_veiculo"] > 0) {
	$filtro[ROTULO_VEICULO] = $_REQUEST["nome_veiculo"];
}
$filtro[ROTULO_DATA_INICIAL] = $_REQUEST["data_hora_inicio"];
$filtro[ROTULO_DATA_FINAL]   = $_REQUEST["data_hora_fim"];

$tabela               = new GerarTabelaXml();
$tabela->dados        = $dados_linha;
$tabela->colunas      = $dados_coluna;
$tabela->filtro       = $filtro;
$tabela->logo_cliente = $_SESSION["logo_cliente"];
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".Almoxarifado_entradas_itens.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
