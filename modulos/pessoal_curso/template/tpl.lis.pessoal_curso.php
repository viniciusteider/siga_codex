<?php
include_once("modulos/pessoal_curso/template/js.lis.pessoal_curso.php");
$_SESSION["FILTRO_PESSOAL_CURSO"] = $_REQUEST;
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

$objPessoalCurso = new PessoalCurso();
$listar = $objPessoalCurso->ListarPaginacao($_SESSION['USUARIO_EDIT'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_pessoal_curso";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MATRÍCULOA","filtro"=> "data_matricula", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "INÍCIO","filtro"=> "data_inicio", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TÉRMINO","filtro"=> "data_termino", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MEDIA FINAL","filtro"=> "media_final", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CARGA HORÁRIA","filtro"=> "carga_horaria", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FORMATO CURSO","filtro"=> "formato_curso", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "OBSERVACOES","filtro"=> "observacoes", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_matricula"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_inicio"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_termino"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["media_final"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["carga_horaria"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["formato_curso"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacoes"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["pessoal_curso"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = true;
$grid->permitir_select_registros = false;
$grid->funcao_atualizar = "AtualizarGridPessoalCurso";
$grid->funcao_modificar = "ModificarPessoalCurso";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroPessoalCurso";
$grid->id_botao_excluir = "ExcluirRegistroPessoalCurso";
$grid->id_checkbox_master = "master_PessoalCurso";
$grid->nome_lista_checkbox = "lista_PessoalCurso";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
