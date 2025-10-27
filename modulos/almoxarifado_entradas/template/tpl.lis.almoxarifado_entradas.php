<?php
include_once("modulos/almoxarifado_entradas/template/js.lis.almoxarifado_entradas.php");
$_SESSION["FILTRO_ALMOXARIFADO_ENTRADAS"] = $_REQUEST;
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

$objAlmoxarifadoEntradas = new AlmoxarifadoEntradas();
$listar = $objAlmoxarifadoEntradas->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_almoxarifado_entradas";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOTA FISCAL","filtro"=> "numero_nota_fiscal", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA NF","filtro"=> "data_emissao_nota_fiscal", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "RECEBIMENTO","filtro"=> "data_recebimento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "VALOR","filtro"=> "valor_nota", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "INTES","filtro"=> "valor_nota", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){

        $dados = '<div class="d-flex align-items-center">
            <div class="d-flex justify-content-start flex-column">
                <p class="text-dark fw-bold text-hover-primary mb-1 fs-6"><i class="fa fa-user-gear"></i> '.$linha['numero_nota_fiscal'].'</p>
                <span class="text-muted fw-semibold text-muted d-block  mb-1 fs-7" >Almoxarifado: '.$linha["nome_almoxarifado"].'</span>
                <span class="text-muted fw-semibold text-muted d-block  mb-1  fs-7" >setor: '.$linha['nome_setor'].'</span>
            </div>
        </div>';
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $dados];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_emissao_nota_fiscal"], $_SESSION["usuario"]["timezone"],'d/m/y')];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_recebimento"], $_SESSION["usuario"]["timezone"],'d/m/y')];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["valor_nota"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["itens"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["almoxarifado_entradas"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridAlmoxarifadoEntradas";
$grid->funcao_modificar = "ModificarAlmoxarifadoEntradas";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroAlmoxarifadoEntradas";
$grid->id_botao_excluir = "ExcluirRegistroAlmoxarifadoEntradas";
$grid->id_checkbox_master = "master_AlmoxarifadoEntradas";
$grid->nome_lista_checkbox = "lista_AlmoxarifadoEntradas";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
