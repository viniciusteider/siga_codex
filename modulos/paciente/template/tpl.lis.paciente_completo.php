<?php
include_once("modulos/paciente/template/js.lis.paciente.php");
$_SESSION["FILTRO_PACIENTE_COMPLETO"] = $_REQUEST;
$_REQUEST["numero_registros"] = ($_REQUEST["numero_registro_hidden"] != "") ? $_REQUEST["numero_registro_hidden"] : $_REQUEST["numero_registros"];
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$parametros['id_ocorrencia'] = $_REQUEST['id_ocorrencia'];
$parametros['timezone'] = $_SESSION['usuario']['timezone'] ?? null;
$busca = $_REQUEST["busca"];
$pagina = $_REQUEST["pagina"];
$filtro = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($pagina == "") { $pagina = 0; }

$numeroRegistros = ($_REQUEST["numero_registros"] == "") ? 50 :(int) $_REQUEST["numero_registros"];
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objPaciente = new Paciente();
$listar = $objPaciente->ListarPaginacaoCompleto($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_paciente";

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Nome","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Idade","filtro"=> "idade", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Sexo","filtro"=> "sexo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "RG","filtro"=> "rg", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CPF","filtro"=> "cpf", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Data Recebimento","filtro"=> "data_recebimento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Profissional","filtro"=> "profissional", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Tipo Encaminhamento","filtro"=> "tipo_encaminhamento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Situação","filtro"=> "id_situacao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Hospital","filtro"=> "id_hospital", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Idade Gestacional","filtro"=> "idade_gestacional", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "BCF","filtro"=> "bcf", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Apgar 1","filtro"=> "apgar_1", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Apgar 5","filtro"=> "apgar_5", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Tipo Obstetrícia","filtro"=> "id_tipo_obstetricia", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Respiração","filtro"=> "id_respiracao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Vias Aéreas","filtro"=> "id_vias_aereas", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Pupilas","filtro"=> "id_pupilas", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Pupilas Sintomas"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Etnia","filtro"=> "id_etnia", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Telefone","filtro"=> "telefone", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Comercial","filtro"=> "comercial", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Celular","filtro"=> "celular", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Recusa Atendimento","filtro"=> "recusa_atendimento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Recusa Transporte","filtro"=> "recusa_transporte", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Observações","filtro"=> "observacao", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Logradouro","filtro"=> "logradouro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Número","filtro"=> "numero", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Complemento","filtro"=> "complemento", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Bairro","filtro"=> "bairro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Cidade","filtro"=> "cidade", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Estado","filtro"=> "estado", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Referência","filtro"=> "referencia", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Latitude","filtro"=> "latitude", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Longitude","filtro"=> "longitude", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Endereço Completo","filtro"=> "endereco_completo", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Lesões"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Procedimentos Padrões"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Procedimentos Sondagens"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Procedimentos Curativos"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Procedimentos Imobilizações"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Medicamentos"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Sinais Vitais"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Sinais Clínicos"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Obstetrícia"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "Circulação"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "60"];

$x = 0;
if(@count($listar[0])> 0){
        foreach($listar[0] as $linhaPaciente){
        $prontuario = Componente::GerarBotao([
            "tamanho" => true,
            "target" => '_blank',
            "href" => "index_xml.php?app_modulo=paciente&app_comando=paciente_pdf&app_codigo=". $linhaPaciente["id"],
            "class" => 'btn btn-sm btn-icon  btn-warning ',
            "icon_class" => 'fas fa-list ',
            "title" => "Prontuário"
        ]);
        $materiais = Componente::GerarBotao([
            "tamanho" => true,
            "onclick" => 'AbrirMateriais('.$linhaPaciente['id'].')',
            "href" => "javascript:;",
            "class" => 'btn btn-sm btn-icon  btn-dark ',
            "icon_class" => 'bi bi-tools ',
            "title" => "Materiais"
        ]);

        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["id"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["idade"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => ($linhaPaciente["sexo"] == "M") ? "Masculino" : (($linhaPaciente["sexo"] == "F") ?"Feminino" : "Não Informado")];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["rg"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["cpf"]];
        $valorDataRecebimento = ($linhaPaciente["data_recebimento"] && $linhaPaciente["data_recebimento"] != '0000-00-00 00:00:00')
            ? Conexao::PrepararDataPHP($linhaPaciente["data_recebimento"], $_SESSION["usuario"]["timezone"], 'd/m/Y H:i')
            : "";
        $dados_linha[$x]["dados_td"][] = ["valor" => $valorDataRecebimento];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["profissional"]];
        $tipoEncaminhamento = "Não Informado";
        if ((int)$linhaPaciente['tipo_encaminhamento'] === 1) {
            $tipoEncaminhamento = "Regular";
        } elseif ((int)$linhaPaciente['tipo_encaminhamento'] === 2) {
            $tipoEncaminhamento = "Vaga Zero";
        }
        $dados_linha[$x]["dados_td"][] = ["valor" => $tipoEncaminhamento];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_situacao"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_hospital"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["idade_gestacional"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["bcf"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["apgar_1"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["apgar_5"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_tipo_obstetricia"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_respiracao"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_vias_aereas"] ?? ''];
        $pupilasTipo = '';
        if ($linhaPaciente['id_pupilas'] == 1) {
            $pupilasTipo = 'Isocórica';
        } elseif ($linhaPaciente['id_pupilas'] == 2) {
            $pupilasTipo = 'Anisocórica';
        }
        $dados_linha[$x]["dados_td"][] = ["valor" => $pupilasTipo];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_pupilas"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["nome_etnia"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["telefone"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["comercial"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["celular"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => ($linhaPaciente["recusa_atendimento"] == 1) ? "Sim" : "Não"];
        $dados_linha[$x]["dados_td"][] = ["valor" => ($linhaPaciente["recusa_transporte"] == 1) ? "Sim" : "Não"];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["observacao"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["logradouro"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["numero"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["complemento"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["bairro"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["cidade"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["estado"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["referencia"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["latitude"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["longitude"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["endereco_completo"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_lesoes"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_padroes"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_sondagens"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_curativos"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_imobilizacoes"] ?? ''];
        $dados_linha[$x]["dados_td"][] = ["valor" => str_replace('||', ' | ', $linhaPaciente["lista_medicamentos"] ?? '')];
        $dados_linha[$x]["dados_td"][] = ["valor" => str_replace('||', ' | ', $linhaPaciente["lista_sinais_vitais"] ?? '')];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_sinais_clinicos"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_obstetricia"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["lista_circulacao"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linhaPaciente["id"],"nome" => "Alterar","style" => "text-align:right","acoes" => [$prontuario,$materiais]];
        $x++;
        }
}

$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = false;
$grid->permitir_excluir = false;
$grid->funcao_atualizar = "AtualizarGridPaciente";
$grid->funcao_modificar = "ModificarPaciente";
$grid->valor_campo_busca = $busca;
$grid->filtro = $filtro;
$grid->id_botao_adicionar = "AdicionarRegistroPaciente";
$grid->id_botao_excluir = "ExcluirRegistroPaciente";
$grid->id_checkbox_master = "master_Paciente";
$grid->nome_lista_checkbox = "lista_Paciente";
$grid->pagina = $pagina;
$grid->numeroRegistros = $numeroRegistros;
$grid->numeroRegistroIncio = $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
