<?php
include_once("MPDF6/mpdf.php");
$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objRecursos = new Recursos();
$listar = $objRecursos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Id];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Prefixo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Placa];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ano_modelo];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Ano_fabricacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Renavam];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Chassi];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Cor];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_frente];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_traseira];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_direita];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Foto_esquerda];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_carga];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Observacao];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => Data_hora_cadastro];

$x = 0;
if (@count($listar[0]) > 0) {
	foreach ($listar[0] as $linha) {
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["prefixo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["placa"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_modelo"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_fabricacao"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["renavam"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["chassi"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cor"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_frente"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_traseira"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_direita"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_esquerda"],"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_carga"], $_SESSION["usuario"]["id_fuso_horario"]),"class"=> "uppercase"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacao"],"class"=> "uppercase"];
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

$tabela             = new GerarTabelaPdf();
$tabela->id_cliente = $_SESSION["usuario"]["id_cliente"];
$tabela->cabecalho  = $filtro;
$tabela->colunas    = $dados_coluna;
$tabela->dados      = $dados_linha;

//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4-L");
$mpdf->WriteHTML($tabela->CriarTabela());
$mpdf->Output();
