<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objLigacoes = new Ligacoes();
$listar = $objLigacoes->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Tempo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Latitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Longitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Descritivo];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["tempo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]), "class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["descritivo"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ligacoes"]);

$filtro[ROTULO_LISTAGEM] = Ligacoes;
//$filtro[ROTULO_RELATORIO] = Ligacoes;
if ($_REQUEST["id_grupo"] > 0) {
	$filtro[ROTULO_GRUPO] = $_REQUEST["nome_grupo"];
}
if ($_REQUEST["id_veiculo"] > 0) {
	$filtro[ROTULO_VEICULO] = $_REQUEST["nome_veiculo"];
}
$filtro[ROTULO_DATA_INICIAL] = $_REQUEST["data_hora_inicio"];
$filtro[ROTULO_DATA_FINAL]   = $_REQUEST["data_hora_fim"];

$tabela                 = new GerarTabelaPrint();
$tabela->buscaAtiva     = false;
$tabela->nome           = "";
$tabela->totalRegistros = $listar[1]->total;
$tabela->dados          = $dados_linha;
$tabela->center         = $center;
$tabela->colunas        = $dados_coluna;
$tabela->botaoAdicionar = false;
$tabela->botao          = false;
$tabela->paginacao      = false;
$tabela->filtro         = $filtro;
echo $tabela->CriarTabela();
