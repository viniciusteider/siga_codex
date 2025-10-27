<?php
include_once("modulos/paciente_sinais_vitais/template/js.lis.paciente_sinais_vitais.php");
$_SESSION["FILTRO_PACIENTE_SINAIS_VITAIS"] = $_REQUEST;
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

$objPacienteSinaisVitais = new PacienteSinaisVitais();
$listar = $objPacienteSinaisVitais->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_paciente_sinais_vitais";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HORARIO","filtro"=> "horario", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PRESSAO_ARTERIAL_MINIMA","filtro"=> "pressao_arterial_minima", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PRESSAO_ARTERIAL_MAXIMA","filtro"=> "pressao_arterial_maxima", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FREQUENCIA_CARDIACA","filtro"=> "frequencia_cardiaca", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FREQUENCIA_RESPIRATORIA","filtro"=> "frequencia_respiratoria", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SATURACAO_O2","filtro"=> "saturacao_o2", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "GLASGOW","filtro"=> "glasgow", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TEMPERATURA","filtro"=> "temperatura", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HGT","filtro"=> "hgt", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ESCALA_TRAUMA","filtro"=> "escala_trauma", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA_HORA_CADASTRO","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["horario"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["pressao_arterial_minima"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["pressao_arterial_maxima"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["frequencia_cardiaca"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["frequencia_respiratoria"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["saturacao_o2"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["glasgow"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["temperatura"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["hgt"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["escala_trauma"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["timezone"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["paciente_sinais_vitais"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridPacienteSinaisVitais";
$grid->funcao_modificar = "ModificarPacienteSinaisVitais";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroPacienteSinaisVitais";
$grid->id_botao_excluir = "ExcluirRegistroPacienteSinaisVitais";
$grid->id_checkbox_master = "master_PacienteSinaisVitais";
$grid->nome_lista_checkbox = "lista_PacienteSinaisVitais";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
