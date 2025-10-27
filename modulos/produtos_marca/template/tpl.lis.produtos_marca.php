<?php
include_once("modulos/produtos_marca/template/js.lis.produtos_marca.php");
$_SESSION["FILTRO_PRODUTOS_MARCA"] = $_REQUEST;
$_REQUEST["numero_registros"] = ($_REQUEST["numero_registro_hidden"] != "") ? $_REQUEST["numero_registro_hidden"] : $_REQUEST["numero_registros"];
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}
$parametros["id_grupo"] = $_SESSION['usuario']['id_grupo'];
$parametros["busca"] = $_REQUEST["busca"];
$parametros["pagina"] = $_REQUEST["pagina"];
$parametros["filtro"] = $_REQUEST["filtro"];
($_REQUEST["ordem"] == "desc")? $ordem = "asc": $ordem = "desc";
if($parametros["pagina"] == "") { $parametros["pagina"] = 0; }

$parametros["numero_registros"] = ($_REQUEST["numero_registros"] == "") ? 50 :(int) $_REQUEST["numero_registros"];
$parametros["numero_inicio_registro"] = (int) $parametros["pagina"] * $parametros["numero_registros"];

$objProdutosMarca = new ProdutosMarca();
$listar = $objProdutosMarca->ListarPaginacao($parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_produtos_marca";

$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "DATA CADASTRO","filtro"=> "data_hora_cadastro", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
    foreach($listar[0] as $linha){
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"class"=> "checkboxes","nome" => "box"];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome"]];
        $dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_cadastro"], $_SESSION["usuario"]["timezone"])];
        $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"],"nome" => "Alterar","style" => "text-align:right"];
        $x++;
    }
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["produtos_marca"]);
$grid = new SquallTable();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_busca = true;
$grid->funcao_atualizar = "AtualizarGridProdutosMarca";
$grid->funcao_modificar = "ModificarProdutosMarca";
$grid->id_botao_adicionar = "AdicionarRegistroProdutosMarca";
$grid->id_botao_excluir = "ExcluirRegistroProdutosMarca";
$grid->id_checkbox_master = "master_ProdutosMarca";
$grid->nome_lista_checkbox = "lista_ProdutosMarca";
$grid->parametros = $parametros;
$grid->totalRegistros = $listar[1];
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
