<?php
include_once("modulos/ocorrencias/template/js.lis.ocorrencias.php");
$_SESSION["FILTRO_OCORRENCIAS"] = $_REQUEST;
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

$objOcorrencias = new Ocorrencias();
$listar = $objOcorrencias->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_ocorrencias";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA","filtro"=> "data_hora", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "TELEFONE","filtro"=> "telefone", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "#", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
	foreach($listar[0] as $linha){

        $endereco = '     <div class="d-flex align-items-center">
             
                        <div class="d-flex justify-content-start flex-column">
                         <span class="text-gray-400 fw-semibold d-block ">'.$linha['id'].' - '.$linha['nome'].'</span>  
                            <a href="#index_xml.php?app_modulo=servicos&app_comando=visualizar_servico&app_codigo='.$linha["id"].'" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-8">'.$linha['logradouro'].' , '.$linha['numero'].' '.$linha['bairro'].' '.$linha['cidade'].' '.$linha['estado'].'</a>
                            <span class="text-gray-400 fw-semibold d-block fs-9">'.$linha['telefone'].'</span>
                        </div>
                    </div>';

        $boletim = Componente::GerarBotao([
            "tamanho" => true,
            "target" => '_blank',
            "href" => "index_xml.php?app_modulo=ocorrencias&app_comando=ocorrencias_print&app_codigo=". $linha["id"],
            "class" => 'btn btn-sm btn-icon  btn-warning ',
            "icon_class" => 'fas fa-list ',
            "title" => "Escala Mensal"
        ]);


        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora"], $_SESSION["usuario"]["id_fuso_horario"])];
		$dados_linha[$x]["dados_td"][] = ["valor" => $endereco];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["celular"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $boletim,"nome" => "acores","style" => "text-align:right"];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["ocorrencias"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->permitir_adicionar = false;
$grid->permitir_excluir = false;
$grid->funcao_atualizar = "AtualizarGridOcorrencias";
$grid->funcao_modificar = "ModificarOcorrencias";
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
