<?php
include_once("modulos/escala_flex/template/js.lis.escala_flex.php");
$_SESSION["FILTRO_ESCALA_MENSAL"] = $_REQUEST;
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

$objEscalaMensal = new EscalaMensal();
$listar = $objEscalaMensal->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);
//Conexao::pr($listar[0]);
//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_escala_mensal";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LOCAL","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FUNÇÃO","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ENTRADA","filtro"=> "data_hora_entrada", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SAÍDA","filtro"=> "data_hora_saida", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linhas) {
	    $rowspan = count($linhas);
        $dados_linha[$x]["dados_td"][] = ["valor" => "<strong>" . $linhas[0]["nome_local"] . "</strong>","rowspan" => "$rowspan","align" => "center" ];
        foreach ($linhas as $linha) {
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"], "class" => "checkboxes", "nome" => "box"];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_usuario"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_funcao"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_entrada"], $_SESSION["usuario"]["timezone"])];
            $dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_saida"], $_SESSION["usuario"]["timezone"])];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"], "nome" => "Alterar", "style" => "text-align:right"];
            $x++;
        }
        $dados_linha[$x]["dados_tr"] = ["class" => "bg-dark"];
        $dados_linha[$x]["dados_td"][] = ["valor" => "","colspan" => "8"];
        $x++;
    }
}

    $Copiar = Componente::GerarBotao([
    "tamanho" => false,
    "href" => "javascript:;",
    "onclick" => 'ReplicarEscala()',
    "class" => 'btn btn-sm   btn-info ',
    "icon_class" => 'fas fa-clock ',
    "texto" => "Replicar Escala",
    "title" => "Replicar Escala"
]);

//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["escala_mensal"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->botao_outros = $Copiar;
$grid->permitir_busca = false;
$grid->funcao_atualizar = "AtualizarGridEscalaMensal";
$grid->funcao_modificar = "ModificarEscalaMensal";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroEscalaMensal";
$grid->id_botao_excluir = "ExcluirRegistroEscalaMensal";
$grid->id_checkbox_master = "master_EscalaMensal";
$grid->nome_lista_checkbox = "lista_EscalaMensal";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
