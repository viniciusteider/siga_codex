<?php
include_once("modulos/ligacoes/template/js.lis.ligacoes.php");
$_SESSION["FILTRO_LIGACOES"] = $_REQUEST;
$_REQUEST["numero_registros"] = ($_REQUEST["numero_registro_hidden"] != "") ? $_REQUEST["numero_registro_hidden"] : $_REQUEST["numero_registros"];
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

$numeroRegistros = ($_REQUEST["numero_registros"] == "") ? 50 :(int) $_REQUEST["numero_registros"];
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objLigacoes = new Ligacoes();
$listar = $objLigacoes->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_ligacoes";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NUMERO","filtro"=> "numero", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TEMPO","filtro"=> "tempo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LATITUDE","filtro"=> "latitude", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LONGITUDE","filtro"=> "longitude", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA_HORA_CADASTRO","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DESCRITIVO","filtro"=> "descritivo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["numero"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["tempo"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitude"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["descritivo"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ligacoes"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridLigacoes";
$grid->funcao_modificar = "ModificarLigacoes";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroLigacoes";
$grid->id_botao_excluir = "ExcluirRegistroLigacoes";
$grid->id_checkbox_master = "master_Ligacoes";
$grid->nome_lista_checkbox = "lista_Ligacoes";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
