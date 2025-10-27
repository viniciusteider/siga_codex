<?
include_once("modulos/monitor/template/js.lis.cliente.monitor.php");
$busca = $_REQUEST["busca"];
$pagina = $_REQUEST["pagina"];
$filtro = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($pagina == "") { $pagina = 0; }

$numeroRegistros = 50;
$numeroInicioRegistro = $pagina * $numeroRegistros;

$objCliente = new Cliente();
$listar = $objCliente->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_cliente";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID GRUPO","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CPF/CNPJ","filtro"=> "cpf_cnpj", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "CELULAR","filtro"=> "endereco.celular", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "STATUS","filtro"=> "status", "tipo"=> "$ordem"];

$x = 0;
if(@count($listar[0])> 0){
    foreach($listar[0] as $linha){
        $status = ($linha['status'] == 1) ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>';
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id_grupo"],"class"=> "checkboxes","nome" => "box"];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id_grupo"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => ($linha["nome"])?$linha["nome"]:$linha["nome_fantasia"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["cpf_cnpj"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["celular"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $status];
        $x++;
    }
}

$bt_Filtrar = Componente::GerarBotao([
    "tamanho" => false,
    "href" => "javascript:;",
    "onclick" => "FiltrarCliente()",
    "class" => 'btn btn-sm btn-success m-r-5 m-b-5  hover-scale ',
    "icon_class" => 'fas fa-upload',
    "title" => "Adicionar Clientes ao Grid",
    "texto" => "Adicionar Clientes ao Grid"
]);

$grid = new GerarGrid();
$grid->permitir_adicionar = false;
$grid->permitir_excluir = false;
$grid->titulo = "";
$grid->permitir_paginacao_top = false;
$grid->permitir_adicionar = false;
//$grid->botao_outros = $bt_Filtrar;
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->funcao_atualizar = "AtualizarGridCliente";
$grid->funcao_modificar = "ModificarCliente";
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
