<?php

$parametros['id_base'] = $_REQUEST['id_base'];
$parametros['id_estado'] = $_REQUEST['id_estado'];
$parametros['id_cidade'] = $_REQUEST['id_cidade'];
$parametros['id_grupo'] = $_SESSION['usuario']['id_grupo'];
if (!empty($_REQUEST['periodo'])) {
    list($inicio, $fim) = explode(" - ", $_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$objRelatorio = new RelatorioUniformes();
$listar = $objRelatorio->GerarRelatorio($parametros);


//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"] = "id_tabela_subevento";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "INIFORME"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TAMANHO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "QUANTIDADE"];

$x = 0;
if (@count($listar) > 0) {
    foreach ($listar as $linha) {
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_peca"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_tamanho"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"]];
        $x++;
    }
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["subevento"]);
$filtro['Relatório'] = 'Relatório de Uniformes';

$tabela               = new GerarTabelaXml();
$tabela->dados        = $dados_linha;
$tabela->colunas      = $dados_coluna;
$tabela->filtro       = $filtro;
$tabela->logo_cliente = $_SESSION["logo_cliente"];
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".'Relatorio_uniformes'.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
