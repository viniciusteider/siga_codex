<?php
include_once("MPDF6/mpdf.php");
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objOcorrenciasRecursos = new OcorrenciasRecursos();
$listar = $objOcorrenciasRecursos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Horario_saida_base];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Horario_chegada_local];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Horario_saida_local];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Horario_chegada_hospital];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Horario_chegada_base];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Qta];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ultimo_qta];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_saida_base"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_local"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_saida_local"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_hospital"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_base"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["qta"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ultimo_qta"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ocorrencias_recursos"]);

$filtro[ROTULO_LISTAGEM] = Ocorrencias_recursos;
//$filtro[ROTULO_RELATORIO] = Ocorrencias_recursos;
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
