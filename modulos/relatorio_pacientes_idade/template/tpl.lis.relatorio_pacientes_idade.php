<style>
    table td,th {
        font-size: 11px !important;
    }
</style>
<?php
$_SESSION['FILTRO_RELATORIO_PACIENTE'] = $_REQUEST;
$parametros['id_base'] = $_REQUEST['id_base'];
$parametros['id_estado'] = $_REQUEST['id_estado'];
$parametros['id_cidade'] = $_REQUEST['id_cidade'];
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$parametros['id_evento'] = $_REQUEST['id_evento'];
$parametros['id_subevento'] = $_REQUEST['id_subevento'];
$parametros['busca'] = $_REQUEST['busca'];

$objRelatorio = new RelatorioPacientesIdade();
$listar = $objRelatorio->Gerar($_SESSION['usuario']['id_grupo'],$parametros);


//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_subevento";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MUNICIPIO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "BASE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "EVENTO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SUB"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Até 1"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "1-4"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "5-9"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "10-14"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "15-19"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "20-24"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "25-30"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "31-35"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "36-40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "41-45"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "46-50"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "51-55"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "56-60"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "61-65"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "66-70"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "70+"];

$x = 0;
$totais = [];
if(@count($listar)> 0){
    foreach($listar as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_cidade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_base"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_sub_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_1"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_4"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_9"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_14"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_19"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_24"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_30"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_35"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_40"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_45"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_50"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_55"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_60"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_65"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_70"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade_71"]];;
        $x++;
        $totais["total"] += $linha["total"];
        $totais["idade_1"] += $linha["idade_1"];
        $totais["idade_4"] += $linha["idade_4"];
        $totais["idade_9"] += $linha["idade_9"];
        $totais["idade_14"] += $linha["idade_14"];
        $totais["idade_19"] += $linha["idade_19"];
        $totais["idade_24"] += $linha["idade_24"];
        $totais["idade_30"] += $linha["idade_30"];
        $totais["idade_35"] += $linha["idade_35"];
        $totais["idade_40"] += $linha["idade_40"];
        $totais["idade_45"] += $linha["idade_45"];
        $totais["idade_50"] += $linha["idade_50"];
        $totais["idade_55"] += $linha["idade_55"];
        $totais["idade_60"] += $linha["idade_60"];
        $totais["idade_65"] += $linha["idade_65"];
        $totais["idade_70"] += $linha["idade_70"];
        $totais["idade_71"] += $linha["idade_71"];


    }
    $dados_linha[$x]["dados_td"][] = ["valor" => "TOTAIS"];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["total"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_1"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_4"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_9"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_14"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_19"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_24"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_30"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_35"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_40"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_45"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_50"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_55"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_60"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_65"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_70"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["idade_71"]];
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["subevento"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->permitir_paginacao_top = false;
$grid->permitir_paginacao = false;
$grid->permitir_adicionar = false;
$grid->permitir_excluir = false;
$grid->funcao_atualizar = "AtualizarGridSubevento";
$grid->funcao_modificar = "ModificarSubevento";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = 10000;
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
