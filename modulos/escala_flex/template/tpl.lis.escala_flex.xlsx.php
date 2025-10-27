<?php
if (!empty($_REQUEST['periodo'])){
    list($inicio,$fim) = explode(" - ",$_REQUEST['periodo']);
    $parametros['data_hora_inicio'] = Conexao::PrepararDataBD($inicio . " 00:00:00");
    $parametros['data_hora_fim'] = Conexao::PrepararDataBD($fim . " 23:59:59");
}

$numeroRegistros      = 20000;
$numeroInicioRegistro = 0;
$busca                = $_REQUEST["busca"];

$objEscalaMensal = new EscalaMensal();
$listar = $objEscalaMensal->ListarPaginacao($_SESSION['usuario']['id_grupo'],$numeroRegistros,$numeroInicioRegistro,$busca,$filtro,$ordem,$parametros);

$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "LOCAL","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_caixa_selecao", "nome" => "box", "class"=> "checkboxes","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ID","filtro"=> "id", "tipo"=> "$ordem","width" => "40"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "NOME","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "FUNÇÃO","filtro"=> "id", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "ENTRADA","filtro"=> "data_hora_entrada", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "", "nome" => "SAÍDA","filtro"=> "data_hora_saida", "tipo"=> "$ordem"];
$dados_coluna["dados_th"][] = ["configuracao" => "config_acoes", "nome" => "Alterar", "class"=> "","width" => "40"];

$x = 0;
if(@count($listar[0])> 0){
    foreach($listar[0] as $linhas) {
        $rowspan = count($linhas);
        $dados_linha[$x]["dados_td"][] = ["valor" => "<strong>" . $linhas[0]["nome_local"] . "</strong>","rowspan" => "$rowspan","align" => "center" ];
        foreach ($linhas as $linha) {
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"], "class" => "checkboxes", "nome" => "box"];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_usuario"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_funcao"]];
            $dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_entrada"], $_SESSION["usuario"]["timezone"])];
            $dados_linha[$x]["dados_td"][] = ["valor" => Conexao::PrepararDataPHP($linha["data_hora_saida"], $_SESSION["usuario"]["timezone"])];
            $dados_linha[$x]["dados_td"][] = ["valor" => $linha["id"], "nome" => "Alterar", "style" => "text-align:right"];
            $x++;
        }
        $dados_linha[$x]["dados_tr"] = ["class" => "bg-dark"];
        $dados_linha[$x]["dados_td"][] = ["valor" => "","colspan" => "8"];
        $x++;
    }
}

$Copiar = Componente::GerarBotao([
    "tamanho" => false,
    "href" => "javascript:;",
    "onclick" => 'ReplicarEscala()',
    "class" => 'btn btn-sm   btn-info ',
    "icon_class" => 'fas fa-clock ',
    "texto" => "Replicar Escala",
    "title" => "Replicar Escala"
]);
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["escala_mensal"]);

$filtro["Listagem"] = 'Escala Mensal';

$filtro['Data hora inicio'] = $parametros["data_hora_inicio"];
$filtro['Data hora Fim']   = $parametros["data_hora_fim"];

$tabela               = new GerarTabelaXml();
$tabela->dados        = $dados_linha;
$tabela->colunas      = $dados_coluna;
$tabela->filtro       = $filtro;
$tabela->logo_cliente = $_SESSION["logo_cliente"];
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=Escala_Mensal.xls");
header("Cache-Control: max-age=0");
$tabela->CriarTabelaClasse();
