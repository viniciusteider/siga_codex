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

$objRelatorio = new RelatorioQuantitativoHospital();
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
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SUBEVENTO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL ATEND."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL PACIENTES"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LEVE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MEDIA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "GRAVE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MASC"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FEM"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HOSPITAL"];

$x = 0;
$total= [];
if(@count($listar)> 0){
    foreach($listar as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_cidade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_base"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_sub_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_paciente"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["leve"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["medio"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["grave"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_masculino"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_feminino"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_hospital"]];;
        $total["total"] += $linha["total"];
        $total["total_paciente"]+= $linha["total_paciente"];
        $total["leve"]+= $linha["leve"];
        $total["medio"]+= $linha["medio"];
        $total["grave"]+= $linha["grave"];
        $total["total_masculino"]+= $linha["total_masculino"];
        $total["total_feminino"]+= $linha["total_feminino"];
        $x++;
    }
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["total"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["total_paciente"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["leve"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["medio"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["grave"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["total_masculino"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $total["total_feminino"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => ""];;
}
$filtro['Relatório'] = 'HOSPITAL DE ENCAMINHAMENTO';

$tabela               = new GerarTabelaXml();
$tabela->dados        = $dados_linha;
$tabela->colunas      = $dados_coluna;
$tabela->filtro       = $filtro;
$tabela->logo_cliente = $_SESSION["logo_cliente"];
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".'Relatorio_atendimento'.".xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
