<?php
include_once("modulos/veiculos_acidentes/template/js.lis.veiculos_acidentes.php");
$_SESSION["FILTRO_VEICULOS_ACIDENTES"] = $_REQUEST;
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

$objVeiculosAcidentes = new VeiculosAcidentes();
$listar = $objVeiculosAcidentes->ListarPaginacao($_REQUEST['id_ocorrencia'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_veiculos_acidentes";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CONDUTOR","filtro"=> "condutor", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CNH_CONDUTOR","filtro"=> "cnh_condutor", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PROPRIETARIO","filtro"=> "proprietario", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TIPO","filtro"=> "destruicao_tipo", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DESTRUICAO_DESCRICAO","filtro"=> "destruicao_descricao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SEGURADORA","filtro"=> "seguradora", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CARGA","filtro"=> "carga_perigosa", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PLACA","filtro"=> "placa_veiculo", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "COR","filtro"=> "cor", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA_HORA_CADASTRO","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["condutor"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cnh_condutor"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["proprietario"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["destruicao_tipo"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["destruicao_descricao"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["seguradora"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["carga_perigosa"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["placa_veiculo"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cor"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["timezone"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["veiculos_acidentes"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridVeiculosAcidentes";
$grid->funcao_modificar = "ModificarVeiculosAcidentes";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroVeiculosAcidentes";
$grid->id_botao_excluir = "ExcluirRegistroVeiculosAcidentes";
$grid->id_checkbox_master = "master_VeiculosAcidentes";
$grid->nome_lista_checkbox = "lista_VeiculosAcidentes";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
