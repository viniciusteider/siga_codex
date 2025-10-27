<?php
include_once("modulos/ocorrencias_recursos/template/js.lis.ocorrencias_recursos.php");
$_SESSION["FILTRO_OCORRENCIAS_RECURSOS"] = $_REQUEST;
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

$objOcorrenciasRecursos = new OcorrenciasRecursos();
$listar = $objOcorrenciasRecursos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_ocorrencias_recursos";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA","filtro"=> "data", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO_SAIDA_BASE","filtro"=> "horario_saida_base", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO_CHEGADA_LOCAL","filtro"=> "horario_chegada_local", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO_SAIDA_LOCAL","filtro"=> "horario_saida_local", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO_CHEGADA_HOSPITAL","filtro"=> "horario_chegada_hospital", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO_CHEGADA_BASE","filtro"=> "horario_chegada_base", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "QTA","filtro"=> "qta", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ULTIMO_QTA","filtro"=> "ultimo_qta", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_saida_base"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_local"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_saida_local"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_hospital"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["horario_chegada_base"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["qta"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ultimo_qta"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ocorrencias_recursos"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridOcorrenciasRecursos";
$grid->funcao_modificar = "ModificarOcorrenciasRecursos";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroOcorrenciasRecursos";
$grid->id_botao_excluir = "ExcluirRegistroOcorrenciasRecursos";
$grid->id_checkbox_master = "master_OcorrenciasRecursos";
$grid->nome_lista_checkbox = "lista_OcorrenciasRecursos";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
