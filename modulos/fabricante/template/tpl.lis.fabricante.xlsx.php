<?php
$parametros["id_grupo"] = $_SESSION['usuario']['id_grupo'];
$parametros["busca"] = $_REQUEST["busca"];
$parametros["pagina"] = $_REQUEST["pagina"];
$parametros["filtro"] = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($parametros["pagina"] == "") { $parametros["pagina"] = 0; }

$parametros["numero_registros"] = ($_REQUEST["numero_registros"] == "") ? 20000 :(int) $_REQUEST["numero_registros"];
$parametros["numero_inicio_registro"] = 0;


$objFabricante = new Fabricante();
$listar = $objFabricante->ListarPaginacao($parametros);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cnpj];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Contatos_tecnicos];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Contatos_comerciais];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Observacoes];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Liberado];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnpj"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["contatos_tecnicos"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["contatos_comerciais"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacoes"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["liberado"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["fabricante"]);

$filtro[ROTULO_LISTAGEM] = Fabricante;
//$filtro[ROTULO_RELATORIO] = Fabricante;
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
header("Content-Disposition: attachment;filename=".Fabricante.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
