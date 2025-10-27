<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objVacinaTipo = new VacinaTipo();
$listar = $objVacinaTipo->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Qt_doses];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Indicacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Intervalo_doses];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["qt_doses"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["indicacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["intervalo_doses"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["vacina_tipo"]);

$filtro[ROTULO_LISTAGEM] = Vacina_tipo;
//$filtro[ROTULO_RELATORIO] = Vacina_tipo;
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
header("Content-Disposition: attachment;filename=".Vacina_tipo.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
