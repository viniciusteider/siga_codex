<?php
include_once("modulos/consorcio/template/js.lis.consorcio.php");
$_SESSION["FILTRO_ . $LINHA[0] . "] = $_REQUEST;
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$busca = $_REQUEST["busca"];
$pagina = $_REQUEST["pagina"];
$filtro = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($pagina == "") { $pagina = 0; }

$numeroRegistros = 50;
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objConsorcio = new Consorcio();
$listar = $objConsorcio->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_consorcio";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME_CONSORCIO","filtro"=> "nome_consorcio", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CNPJ","filtro"=> "cnpj", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ENDERECO","filtro"=> "endereco", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NR_ENDERECO","filtro"=> "nr_endereco", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LATITUDE","filtro"=> "latitude", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LONGITUDDE","filtro"=> "longitudde", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SITE","filtro"=> "site", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "EMAIL","filtro"=> "email", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TELEDNE","filtro"=> "teledne", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PRESIDENTE","filtro"=> "presidente", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "STATUS","filtro"=> "status", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_consorcio"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnpj"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["endereco"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nr_endereco"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitudde"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["site"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["email"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["teledne"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["presidente"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["status"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["consorcio"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->funcao_atualizar = "AtualizarGridConsorcio";
$grid->funcao_modificar = "ModificarConsorcio";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
