<?php
include_once("modulos/paciente/template/js.lis.paciente.php");
$_SESSION["FILTRO_PACIENTE"] = $_REQUEST;
$_REQUEST["numero_registros"] = ($_REQUEST["numero_registro_hidden"] != "") ? $_REQUEST["numero_registro_hidden"] : $_REQUEST["numero_registros"];
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$parametros['id_ocorrencia'] = $_REQUEST['id_ocorrencia'];
$busca = $_REQUEST["busca"];
$pagina = $_REQUEST["pagina"];
$filtro = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($pagina == "") { $pagina = 0; }

$numeroRegistros = ($_REQUEST["numero_registros"] == "") ? 50 :(int) $_REQUEST["numero_registros"];
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objPaciente = new Paciente();
$listar = $objPaciente->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_paciente";

//$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "IDADE","filtro"=> "idade", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SEXO","filtro"=> "sexo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "RG","filtro"=> "rg", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CPF","filtro"=> "cpf", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "RECEBIMENTO","filtro"=> "data_recebimento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){

        $prontuario = Componente::GerarBotao([
            "tamanho" => true,
            "target" => '_blank',
            "href" => "index_xml.php?app_modulo=paciente&app_comando=paciente_pdf&app_codigo=". $linha["id"],
            "class" => 'btn btn-sm btn-icon  btn-warning ',
            "icon_class" => 'fas fa-list ',
            "title" => "Prontuário"
        ]);
        $materiais = Componente::GerarBotao([
            "tamanho" => true,
            "onclick" => 'AbrirMateriais('.$linha['id'].')',
            "href" => "javascript:;",
            "class" => 'btn btn-sm btn-icon  btn-dark ',
            "icon_class" => 'bi bi-tools ',
            "title" => "Materiais"
        ]);
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => ($linha["sexo"] == "M") ? "Masculino" : (($linha["sexo"] == "F") ? "Feminino" : "Não Informado")];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["rg"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["cpf"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_recebimento"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right","acoes" => [$prontuario,$materiais]];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["paciente"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->permitir_excluir = false;
$grid->funcao_atualizar = "AtualizarGridPaciente";
$grid->funcao_modificar = "ModificarPaciente";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroPaciente";
$grid->id_botao_excluir = "ExcluirRegistroPaciente";
$grid->id_checkbox_master = "master_Paciente";
$grid->nome_lista_checkbox = "lista_Paciente";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
