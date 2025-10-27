<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objPessoalPunicao = new PessoalPunicao();
$listar = $objPessoalPunicao->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Gradacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nr_dias];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_punicao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Observacoes];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["gradacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nr_dias"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_punicao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacoes"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["pessoal_punicao"]);

$filtro[ROTULO_LISTAGEM] = Pessoal_punicao;
//$filtro[ROTULO_RELATORIO] = Pessoal_punicao;
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
header("Content-Disposition: attachment;filename=".Pessoal_punicao.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
