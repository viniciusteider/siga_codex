<?php
$parametros["id_grupo"] = $_SESSION['usuario']['id_grupo'];
$parametros["busca"] = $_REQUEST["busca"];
$parametros["pagina"] = $_REQUEST["pagina"];
$parametros["filtro"] = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($parametros["pagina"] == "") { $parametros["pagina"] = 0; }

$parametros["numero_registros"] = ($_REQUEST["numero_registros"] == "") ? 20000 :(int) $_REQUEST["numero_registros"];
$parametros["numero_inicio_registro"] = 0;


$objProdutos = new Produtos();
$listar = $objProdutos->ListarPaginacao($parametros);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Estoque_atual];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Estoque_minimo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Custo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Codigo_barras];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Local];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Compartimento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Referencia];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_cadastro];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_validade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Retornavel];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Controla_estoque];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Saldo_inicial];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Total];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cautelado];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Prefixo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_serie];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_patrimonio];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Numero_tamanho];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Acabamento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Comprimento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Altura];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Profundidade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Registro];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Visualizar_relatorios];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Codigo_interno];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Codigo_prefeitura];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Quantidade_dia_cautela];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["estoque_atual"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["estoque_minimo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["custo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["codigo_barras"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["local"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["compartimento"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["referencia"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_cadastro"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_validade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["retornavel"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["controla_estoque"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["saldo_inicial"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cautelado"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["prefixo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_serie"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_patrimonio"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero_tamanho"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["acabamento"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["comprimento"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["altura"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["profundidade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["registro"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["visualizar_relatorios"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["codigo_interno"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["codigo_prefeitura"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["quantidade_dia_cautela"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["produtos"]);

$filtro[ROTULO_LISTAGEM] = Produtos;
//$filtro[ROTULO_RELATORIO] = Produtos;
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
header("Content-Disposition: attachment;filename=".Produtos.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
