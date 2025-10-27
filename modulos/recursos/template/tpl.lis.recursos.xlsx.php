<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objRecursos = new Recursos();
$listar = $objRecursos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Prefixo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Placa];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ufplaca];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ano_modelo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ano_fabricacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Renavam];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Chassi];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_frente];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_traseira];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_direita];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_esquerda];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_carga];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Observacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Valor_aquisicao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Valor_mercado];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Km_aquisicao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Km_atual];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Potencia];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cilindradas];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Peso_liquido];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Tanque];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Disponibilidade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Proprietario];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_baixa];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Destino_baixa];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_final_garantia];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Capacidade_carga];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Latitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Longitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["prefixo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["placa"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ufplaca"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_modelo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_fabricacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["renavam"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["chassi"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_frente"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_traseira"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_direita"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_esquerda"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_carga"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["valor_aquisicao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["valor_mercado"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["km_aquisicao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["km_atual"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["potencia"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cilindradas"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["peso_liquido"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["tanque"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["disponibilidade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["proprietario"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_baixa"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["destino_baixa"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_final_garantia"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["capacidade_carga"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["recursos"]);

$filtro[ROTULO_LISTAGEM] = Recursos;
//$filtro[ROTULO_RELATORIO] = Recursos;
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
header("Content-Disposition: attachment;filename=".Recursos.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
