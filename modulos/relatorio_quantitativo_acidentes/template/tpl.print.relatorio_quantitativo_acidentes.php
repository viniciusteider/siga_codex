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

$objRelatorio = new RelatorioQuantitativoAcidentes();
$listar = $objRelatorio->Gerar($_SESSION['usuario']['id_grupo'],$parametros);


//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_subevento";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NR REG"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA HORA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "MUNICIPIO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ENDEREÇO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "BAIRRO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LAT"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LONG"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SUBEVENTO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "VÍTIMA"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SEXO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "IDADE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "GRAVIDADE"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "VEÍCULO"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "HOSPITAL"];

$x = 0;
if(@count($listar)> 0){
    foreach($listar as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["data_hora"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_cidade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["endereco"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["bairro"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["latitude"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["longitude"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_subvevento"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_vitima"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["sexo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["idade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["gravidade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_tipo_veiculo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_hospital"]];
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
