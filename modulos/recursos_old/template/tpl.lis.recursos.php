<?php
include_once("modulos/recursos/template/js.lis.recursos.php");
$_SESSION["FILTRO_RECURSOS"] = $_REQUEST;
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

$objRecursos = new Recursos();
$listar = $objRecursos->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_recursos";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PREFIXO","filtro"=> "prefixo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PLACA","filtro"=> "placa", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ANO MODELO","filtro"=> "ano_modelo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ANO FAB.","filtro"=> "ano_fabricacao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "RENAVAM","filtro"=> "renavam", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CHASSI","filtro"=> "chassi", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "COR","filtro"=> "cor", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FOTO_FRENTE","filtro"=> "foto_frente", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FOTO_TRASEIRA","filtro"=> "foto_traseira", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FOTO_DIREITA","filtro"=> "foto_direita", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FOTO_ESQUERDA","filtro"=> "foto_esquerda", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA_CARGA","filtro"=> "data_carga", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "OBSERVACAO","filtro"=> "observacao", "tipo"=> "$ordem"];
//$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA_HORA_CADASTRO","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
    foreach($listar[0] as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_prefixo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["placa"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_modelo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["ano_fabricacao"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["renavam"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["chassi"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["cor"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_frente"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_traseira"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_direita"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["foto_esquerda"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_carga"], $_SESSION["usuario"]["id_fuso_horario"])];
//		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["observacao"]];
//		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["id_fuso_horario"])];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
        $x++;
    }
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["recursos"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridRecursos";
$grid->funcao_modificar = "ModificarRecursos";
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
