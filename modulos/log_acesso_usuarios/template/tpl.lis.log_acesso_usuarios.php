<?
include_once("modulos/log_acesso_usuarios/template/js.lis.log_acesso_usuarios.php");

$_SESSION['FILTRO_LOG'] = $_REQUEST;

if (!empty($_REQUEST['periodo'])) {
    list($inicio, $fim) = explode(" - ", $_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$parametros['usuario'] = $_REQUEST['usuario_filtro'];


$busca = $_REQUEST["busca"];
$pagina = $_REQUEST["pagina"];
$filtro = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($pagina == "") { $pagina = 0; }

$numeroRegistros = 50;
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objLogAcessoUsuarios = new LogAcessoUsuarios();

$listar = $objLogAcessoUsuarios->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_log_acesso_usuarios";

//$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME_USUARIO","filtro"=> "nome_usuario", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PAGINA","filtro"=> "pagina", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "IP","filtro"=> "ip", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DADOS","filtro"=> "dados", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA","filtro"=> "data_hora", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "APLICATIVO","filtro"=> "aplicativo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){
	    $view = '<a class="btn btn-sm btn-icon  btn-dark " href="javascript:;" onclick="AbrirLog('.$linha["id"].')" data-placement="top" title="Visualizar" data-original-title="Visualizar" data-bs-toggle="tooltip"><i class="fas fa-search  btn-sm btn-icon" title="Visualizar"></i></a>';
	    $dados = json_decode($linha["dados"]);
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_usuario"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["pagina"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["ip"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $dados->app_modulo . " - " .$dados->app_comando];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora"], $_SESSION["usuario"]["id_fuso_horario"])];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["aplicativo"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $view,"nome" => "view","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["log_acesso_usuarios"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_excluir = false;
$grid->permitir_adicionar = false;
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridLogAcessoUsuarios";
$grid->funcao_modificar = "ModificarLogAcessoUsuarios";
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
