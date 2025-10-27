<?php
include_once("MPDF6/mpdf.php");
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objAlmoxarifadoEntradas = new AlmoxarifadoEntradas();
$listar = $objAlmoxarifadoEntradas->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_nota_fiscal];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_emissao_nota_fiscal];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_documento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_empenho];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_requisicao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_solicitacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_recebimento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Valor_nota];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Descricao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_nota_fiscal"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_emissao_nota_fiscal"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_documento"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_empenho"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_requisicao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_solicitacao"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_recebimento"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["valor_nota"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["descricao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["almoxarifado_entradas"]);

$filtro[ROTULO_LISTAGEM] = Almoxarifado_entradas;
//$filtro[ROTULO_RELATORIO] = Almoxarifado_entradas;
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
