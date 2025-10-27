<?php

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

$objRelatorio = new RelatorioQuantitativoAtendimento();
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
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CLASSIFICAO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL ATEND."];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TOTAL PACIENTES"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LEVE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MEDIA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "GRAVE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ÓBITO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MASC"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FEM"];

$x = 0;
$totais = [];
if(@count($listar)> 0){
    foreach($listar as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_cidade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_base"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_sub_evento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_classificao"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_paciente"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["leve"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["medio"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["grave"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["obito"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_masculino"]];;
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["total_feminino"]];;

        $totais["total"] += $linha["total"];
        $totais["total_paciente"] += $linha["total_paciente"];
        $totais["leve"] += $linha["leve"];
        $totais["medio"] += $linha["medio"];
        $totais["grave"] += $linha["grave"];
        $totais["obito"] += $linha["obito"];
        $totais["total_masculino"] += $linha["total_masculino"];
        $totais["total_feminino"] +=  $linha["total_feminino"];

        $x++;
    }
    $dados_linha[$x]["dados_td"][] = ["valor" => 'TOTAIS'];
    $dados_linha[$x]["dados_td"][] = ["valor" => ''];
    $dados_linha[$x]["dados_td"][] = ["valor" => ''];
    $dados_linha[$x]["dados_td"][] = ["valor" => ''];
    $dados_linha[$x]["dados_td"][] = ["valor" => ''];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["total"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["total_paciente"]];
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["leve"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["medio"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["grave"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["obito"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["total_masculino"]];;
    $dados_linha[$x]["dados_td"][] = ["valor" => $totais["total_feminino"]];
}

$filtro['Relatório'] = 'Atendimentos Pacientes';

$tabela             = new GerarTabelaPdf();
$tabela->id_cliente = $_SESSION["usuario"]["id_cliente"];
$tabela->cabecalho  = $filtro;
$tabela->colunas    = $dados_coluna;
$tabela->dados      = $dados_linha;

include_once("MPDF6/mpdf.php");

//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4-L");
$mpdf->WriteHTML($tabela->CriarTabela());
$mpdf->Output();
