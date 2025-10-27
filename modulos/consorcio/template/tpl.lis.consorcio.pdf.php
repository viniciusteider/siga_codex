<?php
include_once("MPDF6/mpdf.php");
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objConsorcio = new Consorcio();
$listar = $objConsorcio->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nome_consorcio];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cnpj];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Endereco];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Nr_endereco];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Latitude];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Longitudde];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Site];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Email];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Teledne];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Presidente];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Status];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_consorcio"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnpj"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["endereco"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nr_endereco"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitudde"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["site"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["email"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["teledne"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["presidente"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["status"],"class"=> "uppercase"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["consorcio"]);

$filtro[ROTULO_LISTAGEM] = Consorcio;
//$filtro[ROTULO_RELATORIO] = Consorcio;
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
