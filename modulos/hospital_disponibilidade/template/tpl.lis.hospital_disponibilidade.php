<?php
include_once("modulos/hospital_disponibilidade/template/js.lis.hospital_disponibilidade.php");
$_SESSION["FILTRO_HOSPITAL_DISPONIBILIDADE"] = $_REQUEST;
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

$objHospitalDisponibilidade = new HospitalDisponibilidade();
$listar = $objHospitalDisponibilidade->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_hospital_disponibilidade";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HOSPITAL","filtro"=> "complexidade", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "COMPLEXIDADE","filtro"=> "complexidade", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LEITOS","filtro"=> "total_leitos", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DISP.","filtro"=> "leitos_disponiveis", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "UTI","filtro"=> "vagas_uti", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DISP","filtro"=> "uti_disponiveis", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ATUALIZAÇÃO","filtro"=> "data_hora_atualizacao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "POR","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_hospital"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["complexidade"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_leitos"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["leitos_disponiveis"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["vagas_uti"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["uti_disponiveis"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_atualizacao"], $_SESSION["usuario"]["timezone"])];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_usuario"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["hospital_disponibilidade"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = true;
$grid->funcao_atualizar = "AtualizarGridHospitalDisponibilidade";
$grid->funcao_modificar = "ModificarHospitalDisponibilidade";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroHospitalDisponibilidade";
$grid->id_botao_excluir = "ExcluirRegistroHospitalDisponibilidade";
$grid->id_checkbox_master = "master_HospitalDisponibilidade";
$grid->nome_lista_checkbox = "lista_HospitalDisponibilidade";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
