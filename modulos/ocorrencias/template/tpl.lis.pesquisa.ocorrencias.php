<?php
$_REQUEST["numero_registros"] = (isset($_REQUEST["numero_registro_hidden"]) && $_REQUEST["numero_registro_hidden"] != "") ? $_REQUEST["numero_registro_hidden"] : (isset($_REQUEST["numero_registros"]) ? $_REQUEST["numero_registros"] : 20);
if ($_REQUEST["numero_registros"] == "") {
    $_REQUEST["numero_registros"] = 20;
}

$busca = "";
$pagina = isset($_REQUEST["pagina"]) && $_REQUEST["pagina"] !== "" ? (int) $_REQUEST["pagina"] : 0;
$filtro = isset($_REQUEST["filtro"]) ? $_REQUEST["filtro"] : "";
$ordemAtual = isset($_REQUEST["ordem"]) ? $_REQUEST["ordem"] : "";
$ordem = ($ordemAtual == "desc") ? "asc" : "desc";

$numeroRegistros = (int) $_REQUEST["numero_registros"];
$numeroInicioRegistro = $pagina * $numeroRegistros;

$parametros = [];

if (!empty($_REQUEST['id_ocorrencia'])) {
    $parametros['id'] = (int) $_REQUEST['id_ocorrencia'];
}

if (!empty($_REQUEST['periodo'])) {
    $periodo = explode(" - ", $_REQUEST['periodo']);
    if (count($periodo) === 2) {
        $inicio = trim($periodo[0]);
        $fim = trim($periodo[1]);
        if ($inicio !== "") {
            $parametros['data_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
        }
        if ($fim !== "") {
            $parametros['data_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
        }
    }
}

if (!empty($_REQUEST['endereco'])) {
    $parametros['endereco'] = $_REQUEST['endereco'];
}

if (!empty($_REQUEST['nome_vitima'])) {
    $parametros['nome_vitima'] = $_REQUEST['nome_vitima'];
}

$objOcorrencias = new Ocorrencias();
$listar = $objOcorrencias->ListarPaginacao($_SESSION['usuario']['id_grupo'], $numeroRegistros, $numeroInicioRegistro, $busca, $filtro, $ordem, $parametros);

$dados_form["name"] = "form_pesquisa_ocorrencias";
$dados_form["id"] = "form_pesquisa_ocorrencias";
$dados_form["onsubmit"] = "return false";

$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"] = "tabela_pesquisa_ocorrencias";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID", "filtro" => "ocorrencias.id", "tipo" => $ordem, "width" => "80"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Data/Hora", "filtro" => "ocorrencias.data_hora", "tipo" => $ordem];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Endereço"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Vítimas"];

$dados_linha = [];
if (is_array($listar[0]) && count($listar[0]) > 0) {
    $x = 0;
    foreach ($listar[0] as $linha) {
        $endereco = trim($linha['logradouro'] . ' ' . $linha['numero'] . ' ' . $linha['bairro'] . ' ' . $linha['cidade']);
        $enderecoFormatado = '<div class="d-flex flex-column">'
            . '<span class="fw-semibold">' . htmlspecialchars($endereco, ENT_QUOTES, 'UTF-8') . '</span>'
            . ($linha['descritivo'] ? '<span class="text-gray-500 fs-7">' . htmlspecialchars($linha['descritivo'], ENT_QUOTES, 'UTF-8') . '</span>' : '')
            . '</div>';

        $vitimas = $linha['nomes_vitimas'] ? htmlspecialchars($linha['nomes_vitimas'], ENT_QUOTES, 'UTF-8') : '<span class="text-gray-500">Sem registros</span>';

        $dados_linha[$x]['dados_tr'] = [
            "onclick" => "VisualizarOcorrencia({$linha['id']})",
            "style" => "cursor:pointer;"
        ];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => ($linha["data_hora"] ? Conexao::PrepararDataPHP($linha["data_hora"], $_SESSION["usuario"]["id_fuso_horario"]) : '-')];
        $dados_linha[$x]["dados_td"][] = ["valor" => $enderecoFormatado];
        $dados_linha[$x]["dados_td"][] = ["valor" => $vitimas];
        $x++;
    }
}

$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->permitir_adicionar = false;
$grid->permitir_excluir = false;
$grid->permitir_outros = false;
$grid->permitir_config = false;
$grid->funcao_atualizar = "AtualizarGridPesquisaOcorrencias";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $numeroInicioRegistro;
$grid->ordem = $ordemAtual;
$grid->totalRegistros = $listar[1];
$grid->linhas = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->filtros_form = [
    'pagina' => $pagina,
    'ordem' => $ordemAtual,
    'filtro' => $filtro
];
$grid->campos_hidden = [
    ["name" => "periodo", "id" => "periodo_hidden", "value" => isset($_REQUEST['periodo']) ? htmlspecialchars($_REQUEST['periodo'], ENT_QUOTES, 'UTF-8') : '' ],
    ["name" => "id_ocorrencia", "id" => "id_ocorrencia_hidden", "value" => isset($_REQUEST['id_ocorrencia']) ? htmlspecialchars($_REQUEST['id_ocorrencia'], ENT_QUOTES, 'UTF-8') : '' ],
    ["name" => "endereco", "id" => "endereco_hidden", "value" => isset($_REQUEST['endereco']) ? htmlspecialchars($_REQUEST['endereco'], ENT_QUOTES, 'UTF-8') : '' ],
    ["name" => "nome_vitima", "id" => "nome_vitima_hidden", "value" => isset($_REQUEST['nome_vitima']) ? htmlspecialchars($_REQUEST['nome_vitima'], ENT_QUOTES, 'UTF-8') : '' ],
    ["name" => "numero_registro_hidden", "id" => "numero_registro_hidden_grid", "value" => $_REQUEST["numero_registros"] ]
];
$grid->Gerar();
