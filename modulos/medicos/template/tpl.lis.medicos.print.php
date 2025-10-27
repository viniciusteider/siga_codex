<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objMedicos = new Medicos();
$listar = $objMedicos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Crm];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Tipo_inscricao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Situacao_inscricao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Especialidade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cro_crm];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => UF];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["crm"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["tipo_inscricao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["situacao_inscricao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["especialidade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cro_crm"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["UF"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]), "class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["medicos"]);

$filtro[ROTULO_LISTAGEM] = Medicos;
//$filtro[ROTULO_RELATORIO] = Medicos;
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
