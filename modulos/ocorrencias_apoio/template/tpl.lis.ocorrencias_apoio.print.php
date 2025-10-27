<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objOcorrenciasApoio = new OcorrenciasApoio();
$listar = $objOcorrenciasApoio->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Hora_pedido];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Responsavel_apoio];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Solicitacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Total_pessoas];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Total_veiculos];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Obs_sv];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Despachante];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["hora_pedido"], $_SESSION["usuario"]["id_fuso_horario"]), "class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["responsavel_apoio"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["solicitacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_pessoas"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_veiculos"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["obs_sv"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["despachante"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]), "class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ocorrencias_apoio"]);

$filtro[ROTULO_LISTAGEM] = Ocorrencias_apoio;
//$filtro[ROTULO_RELATORIO] = Ocorrencias_apoio;
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
