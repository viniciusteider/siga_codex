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

$objRelatorio = new RelatorioTempoResposta();
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
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TIPO VTR"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "VIATURA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ATENDIMENTOS"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TEMPO SAÍDA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TEMPO DESLOC."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TEMPO ATEND."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DESLOC. HOSP."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "PERMAN. HOSP."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DESLOC. BASE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL SAÍDA/BASE"];

$x = 0;
if(@count($listar)> 0){
    foreach($listar as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_cidade"] ];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_base"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_tipo_recurso"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["prefixo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["saida_base"]/ $linha['total'])/60),'0') ."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["chegada_local"]/ $linha['total'])/60),'0')."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["saida_local"]/ $linha['total'])/60),'0')."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["chegada_hospital"]/ $linha['total'])/60),'0')."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["saida_hospital"]/ $linha['total'])/60),'0')."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["chegada_base"]/ $linha['total'])/60),'0')."min"];
        $dados_linha[$x]["dados_td"][] = ["valor" => number_format((($linha["total_operacao"]/ $linha['total'])/60),'0')."min"];
        $x++;
    }
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
