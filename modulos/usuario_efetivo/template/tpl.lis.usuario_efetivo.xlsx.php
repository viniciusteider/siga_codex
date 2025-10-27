<?php
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objUsuarioEfetivo = new UsuarioEfetivo();
$listar = $objUsuarioEfetivo->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Apelido];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome_mae];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome_pai];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_nascimento];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Naturalidade];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Rg];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cpf];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Pis];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cnh];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Categoria_cnh];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Validade_cnh];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Validade_cve];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Genero];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Tipo_sangue];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Matricula_funcional];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_inclusao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Altura];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Peso];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["apelido"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_mae"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_pai"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_nascimento"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["naturalidade"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["rg"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cpf"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["pis"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnh"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["categoria_cnh"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["validade_cnh"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["validade_cve"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["genero"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["tipo_sangue"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["matricula_funcional"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_inclusao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["altura"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["peso"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["usuario_efetivo"]);

$filtro[ROTULO_LISTAGEM] = Usuario_efetivo;
//$filtro[ROTULO_RELATORIO] = Usuario_efetivo;
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
header("Content-Disposition: attachment;filename=".Usuario_efetivo.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
