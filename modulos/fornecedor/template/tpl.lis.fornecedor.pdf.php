<?php
$parametros["id_grupo"] = $_SESSION['usuario']['id_grupo'];
$parametros["busca"] = $_REQUEST["busca"];
$parametros["pagina"] = $_REQUEST["pagina"];
$parametros["filtro"] = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($parametros["pagina"] == "") { $parametros["pagina"] = 0; }

$parametros["numero_registros"] = ($_REQUEST["numero_registros"] == "") ? 20000 :(int) $_REQUEST["numero_registros"];
$parametros["numero_inicio_registro"] = 0;


$objFornecedor = new Fornecedor();
$listar = $objFornecedor->ListarPaginacao($parametros);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Latitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Longitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cpf];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cnpj];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Qualificacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ramo_atividde];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cpf"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnpj"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["qualificacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ramo_atividde"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["fornecedor"]);

$filtro[ROTULO_LISTAGEM] = Fornecedor;
//$filtro[ROTULO_RELATORIO] = Fornecedor;
if ($_REQUEST["id_grupo"] > 0) {
	$filtro[ROTULO_GRUPO] = $_REQUEST["nome_grupo"];
}
if ($_REQUEST["id_veiculo"] > 0) {
	$filtro[ROTULO_VEICULO] = $_REQUEST["nome_veiculo"];
}
$filtro[ROTULO_DATA_INICIAL] = $_REQUEST["data_hora_inicio"];
$filtro[ROTULO_DATA_FINAL]   = $_REQUEST["data_hora_fim"];

$tabela             = new GerarTabelaPdf();
$tabela->id_cliente = $_SESSION["usuario"]["id_cliente"];
$tabela->cabecalho  = $filtro;
$tabela->colunas    = $dados_coluna;
$tabela->dados      = $dados_linha;

//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4-L");
$mpdf->WriteHTML($tabela->CriarTabela());
$mpdf->Output();
