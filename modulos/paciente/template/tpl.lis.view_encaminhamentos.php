<?php
$objPaciente = new Paciente();
$parametros['data_hora_inicio'] = Conexao::PrepararDataBD(date('d/m/Y') . " 00:00:00",$_SESSION['usuario']['timezone']);
$parametros['data_hora_fim'] = Conexao::PrepararDataBD(date('d/m/Y')  . " 23:59:59",$_SESSION['usuario']['timezone']);
$listar = $objPaciente->ViewEcaminhamentosHora($_SESSION['usuario']['id_grupo'],$parametros);

//dados do formulário
$dados_form["name"] = "form";
$dados_form["id"] = "form";
$dados_form["onsubmit"] = "return false";
// dados da tabela
$dados_tabela["class"] = "table table-hover";
$dados_tabela["id"]    = "id_tabela_paciente";
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "HOSPITAL","rowspan"=> "2","filtro"=> "nome", "tipo"=> "$ordem"];
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "2","colspan"=> "2","align"=> "center","valign"=> "middle"];
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "4","colspan"=> "2","align"=> "center","valign"=> "middle"];
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "6","colspan"=> "2","align"=> "center","valign"=> "middle"];
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "12","colspan"=> "2","align"=> "center","valign"=> "middle"];
$dados_coluna[0]["dados_th"][] = ["configuracao" => "", "nome" => "24","colspan"=> "2","align"=> "center","valign"=> "middle"];

$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "R","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "VZ","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "R","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "VZ","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "R","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "VZ","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "R","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "VZ","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "R","align"=> "center","valign"=> "middle"];
$dados_coluna[1]["dados_th"][] = ["configuracao" => "", "nome" => "VZ","align"=> "center","valign"=> "middle"];

$x = 0;
if(@count($listar)> 0){
	foreach($listar as $linha){
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["nome_hospital"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["duas_horas_1"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["duas_horas_2"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["quatro_horas_1"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["quatro_horas_2"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["seis_horas_1"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["seis_horas_2"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["doze_horas_1"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["doze_horas_2"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["vinte_quatro_horas_1"]];
		$dados_linha[$x]["dados_td"][] = ["valor" => $linha["vinte_quatro_horas_2"]];
		$x++;
	}
}
//Componente::FiltrarRelatorioConfiguracao($dados_coluna, $dados_linha, $_SESSION["configuracao_usuario"]["paciente"]);
$grid = new GerarGrid();
$grid->form = $dados_form;
$grid->tabela = $dados_tabela;
$grid->titulo = "";
$grid->permitir_adicionar = false;
$grid->permitir_paginacao_top = false;
$grid->permitir_paginacao = false;
$grid->multiColunas = true;
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
$grid->numeroRegistroIncio = (int) $pagina * $numeroRegistros;
$grid->ordem = $_REQUEST["ordem"];
$grid->totalRegistros =10000000;
$grid->linhas  = $dados_linha;
$grid->colunas = $dados_coluna;
$grid->Gerar();
